<?php

namespace App\Http\Controllers;

use App\Models\FinalUsedRawMatrial;
use App\Models\MaterialStock;
use App\Models\Product;
use App\Models\Production;
use App\Models\ProductRawMaterial;
use App\Models\ProductStock;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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
        $productions = Production::latest()->get();
        return view('admin.production.proccess', compact('productions'));
    }

    public function update(Request $request , $id)
    {
        $finish_good = Production::findOrFail($id);

        $request->validate([
            'qty' => 'required',
        ]);

        $finish_good->qty = $request->qty;
        $finish_good->save();

        $product_stock = ProductStock::where('purchase_id', $id)->first();

        $product_stock->quantity = $request->qty;
        $product_stock->batch_no = $request->batch_no;
        $product_stock->save();

        return redirect()->route('production-proccess')->with('success');
    }

    public function complete()
    {
        $productions = Production::whereStatus(true)->latest()->get();
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
        return view('admin.production.product-pdf',compact('production'));
    }
}
