<?php

namespace App\Http\Controllers;

use App\Models\FinalUsedRawMatrial;
use App\Models\MaterialStock;
use App\Models\Product;
use App\Models\Production;
use App\Models\ProductRawMaterial;
use App\Models\ProductStock;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class ProductionCreateController extends Controller
{
    public function create()
    {
        $products = Product::whereStatus(true)->get();
        return view('admin.production.create', compact('products'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'product' => 'required',
            'qty' => 'required || numeric',
            'batch_no' =>  'required|unique:productions,batch_no'
        ]);

        $qty = $request->qty ?? 0;

        $production = new Production([
            'product_id' => $request->product,
            'qty' => $qty,
            'batch_no' => $request->batch_no
        ]);

        $raw_materials = ProductRawMaterial::where('product_id', $request->product)->get();

        $canProduce = true;

        foreach ($raw_materials as $rmc) {
            $actual_qty = $qty * $rmc->qty;

            $rmStock = MaterialStock::where('raw_material_id', $rmc->raw_material_id)
                ->where('expiry_date', '>', \Carbon\Carbon::now())
                ->whereOr('quantity', '>', 0)
                ->groupBy('raw_material_id')
                ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
                ->first();


            if (!isset($rmStock) || $rmStock->total_quantity < $actual_qty) {
                $canProduce = false;
                break; // Stop checking other materials if one is not available
            }
        }

        if ($canProduce) {

            // Store the request data in the session
            Session::put('production', [
                'product_id' => $request->product,
                'qty' => $qty,
                'batch_no' => $request->batch_no,
                'expiry_date' => $request->expiry_date
            ]);
            $productionData = Session::get('production');
            $productRawMaterial = ProductRawMaterial::where('product_id', $request->product)->get();

            // Check the session data using dd
            // dd(Session::get('production'));

            return view('admin.production.final', compact('productionData', 'productRawMaterial'));
        } else {
            $needQuantity = $actual_qty - $rmStock->total_quantity;

            // Store the request data in the session
            Session::put('production', $request->all());

            // Check the session data using dd
            // dd(Session::get('production'));

            return redirect()->back()->with([
                'error' => 'Insufficient raw material stock to complete production.',
                'needQuantity' => $needQuantity
            ]);
        }
    }

    public function final_store(Request $request)
    {
        // Retrieve the data from the session
        $sessionData = Session::get('production');

        $qty = $sessionData['qty'] ?? 0;
        // Use the session data to create the Production object
        $production = new Production([
            'product_id' => $sessionData['product_id'],
            'qty' => $sessionData['qty'],
            'batch_no' => $sessionData['batch_no'],
            'expiry_date' => $sessionData['expiry_date']
        ]);

        $raw_materials = ProductRawMaterial::where('product_id', $sessionData['product_id'])->get();

        $canProduce = true;

        foreach ($raw_materials as $key => $rmc) {
            $actual_qty = $request->input('qty')[$key] * $rmc->qty;

            $rmStock = MaterialStock::where('raw_material_id', $rmc->raw_material_id)
                ->where('expiry_date', '>', \Carbon\Carbon::now())
                ->groupBy('raw_material_id')
                ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
                ->first();

            if (!isset($rmStock) || $rmStock->total_quantity < $actual_qty) {
                $canProduce = false;
                // return $needQuantiy;
                break; // Stop checking other materials if one is not available
            }
        }

        if ($canProduce) {
            // return $production;
            $production->save();

            $product_stock = new ProductStock([
                'purchase_id' => $production->id,
                'product_type' => 'App\Models\Production',
                'product_id' =>  $sessionData['product_id'],
                'expiry_date' => $sessionData['expiry_date'],
                'quantity' => $sessionData['qty'],
            ]);

            $product_stock->save();

            foreach ($raw_materials as $key => $item) {
                $final = new FinalUsedRawMatrial;
                $final->production_id = $production->id;
                $final->raw_material_id = $item->raw_material_id;
                $final->qty = $request->input('qty')[$key];
                $final->save();
            }

            $final_raw_materials_id = FinalUsedRawMatrial::where('production_id', $production->id)->get();

            // Update the raw material stock
            try {
                foreach ($final_raw_materials_id as $rmc) {
                    $actual_qty = $qty * $rmc->qty;

                    $rmStocks = MaterialStock::where('raw_material_id', $rmc->raw_material_id)
                        ->where('expiry_date', '>', \Carbon\Carbon::now())
                        ->orderBy('expiry_date')
                        ->get();

                    foreach ($rmStocks as $item) {
                        if ($actual_qty > 0)
                            if ($item->quantity >= $actual_qty) {
                                $item->quantity -= $actual_qty;
                                $actual_qty = 0;
                                $item->save();
                            } else {
                                $actual_qty -= $item->quantity;
                                $item->quantity = 0;
                                $item->save();
                            }
                    }
                }

                return redirect()->route('production-create')->with('success', 'Production completed successfully.');
            } catch (\Exception $e) {
                // Handle exceptions here
                return redirect()->back()->with('error', 'Error updating stock: ' . $e->getMessage());
            }
        } else {
            $needQuantity = $actual_qty - $rmStock->total_quantity;

            // Store the request data in the session
            Session::put('production', $request->all());

            // Check the session data using dd
            // dd(Session::get('production'));

            return redirect()->back()->with([
                'error' => 'Insufficient raw material stock to complete production.',
                'needQuantity' => $needQuantity
            ]);
        }
    }

    public function proccess()
    {

        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = Production::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new Production())->getTable());
        $allProductColumns = Schema::getColumnListing((new Product())->getTable());

        $productions = Production::with('product')
            ->where('qty', '>', 0)
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allProductColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allProductColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere(
                            $column,
                            'LIKE',
                            "%$keyword%"
                        );
                    }
                });

                $query->orWhereHas('product', function ($query) use ($keyword, $allProductColumns) {
                    $query->where(function ($query) use ($keyword, $allProductColumns) {
                        foreach ($allProductColumns as $column) {
                            $query->orWhere($column, 'LIKE', "%$keyword%");
                        }
                    });
                });
            })
            ->latest() // This should be placed before get() to order the results
            ->paginate($rows);



        // $productions = Production::where('qty', '>', 0)->latest()->get();
        $products = Product::whereStatus(true)->get();
        return view('admin.production.proccess', compact('productions', 'products'));
    }

    public function update(Request $request, $id)
    {
        // return $request->post();
        $oldProduction = Production::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'product_id' => "required|exists:products,id",
            'product_qty' => 'required',
            'remaining_qty' => 'required|lte:total_qty',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $batch_no = $oldProduction->batch_no;
        $product_id = $oldProduction->product_id;
        $expiry_date = $oldProduction->expiry_date;

        $total = $oldProduction->qty; //Ex:- 50
        $product_qty = $request->product_qty; //Ex: 40
        $remaining_qty = $request->remaining_qty; //Ex:- 10

        //No. of pieces in production stock which already exist
        $alreadyCreatedProductionsCount = Production::where(['product_id' => $product_id, 'batch_no' => $batch_no])->count() + 1;

        $newProduction = Production::create([
            'product_id' => request()->product_id,
            'qty' => $product_qty, // New qty value Ex:- 40
            'batch_no' => $batch_no,
            'sub_batch_no' => $batch_no . '.' . $alreadyCreatedProductionsCount, //1098.1, 1098.2, 1098.3... etc
            'expiry_date' => $expiry_date,
            'status' => 1 //production is live with stock
        ]);

        //update quantity in existing quantity Ex:- 10
        $oldProduction->update(['qty' => $remaining_qty]);

        $product_stock = new ProductStock;
        $product_stock->product_type = "App\Models\Production";
        $product_stock->product_id = request()->product_id;
        $product_stock->batch_no = $batch_no;
        $product_stock->sub_batch_no = $newProduction->sub_batch_no;
        $product_stock->quantity = $product_qty; //(new entry stock)
        $product_stock->expiry_date = $expiry_date;
        $product_stock->save();

        return redirect()->route('production-proccess')->with('success');
    }

    public function complete()
    {

        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = Production::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new Production())->getTable());
        $allProductColumns = Schema::getColumnListing((new Product())->getTable());

        $productions = Production::with('product')
            ->whereStatus(true)
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allProductColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allProductColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere(
                            $column,
                            'LIKE',
                            "%$keyword%"
                        );
                    }
                });

                $query->orWhereHas('product', function ($query) use ($keyword, $allProductColumns) {
                    $query->where(function ($query) use ($keyword, $allProductColumns) {
                        foreach ($allProductColumns as $column) {
                            $query->orWhere($column, 'LIKE', "%$keyword%");
                        }
                    });
                });
            })
            ->latest() // This should be placed before get() to order the results
            ->paginate($rows);

        // $productions = Production::whereStatus(true)->latest()->get();
        return view('admin.production.complete', compact('productions'));
    }

    public function status(Request $request)
    {
        $production = Production::findOrFail($request->production_id);
        $production->status = $request->status;
        $production->save();

        return redirect()->back();
    }

    public function pdf_generate($id)
    {
        $production = Production::findOrFail($id);
        $issue = Production::with(['finish_raw_material', 'product_raw_material'])->findOrFail($id);
        $finals = Production::with('finish_raw_material')->findOrFail($id);
        $newarr = []; // Define $newarr as an empty array

        if ($finals->finish_raw_material && count($finals->finish_raw_material) > 0) {
            foreach ($finals->finish_raw_material as $key => $item) {
                $newarr[$item->raw_material->name] = $item->qty;
            }
        }


        // $pdf = Pdf::setOption(['debugCss'=>false])->loadView('admin.production.production-pdf', ['production' => $production, 'issue' => $issue, 'newarr' => $newarr]);

        // return $pdf->download($production->product->name.'.pdf');

        return view('admin.production.production-pdf', compact('production', 'issue', 'newarr'));
    }

    public function pdf_product($id)
    {
        $production = Production::findOrFail($id);
        return view('admin.production.product-pdf', compact('production'));
    }
}
