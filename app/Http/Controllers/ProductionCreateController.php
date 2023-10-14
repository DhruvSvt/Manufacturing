<?php

namespace App\Http\Controllers;

use App\Models\FinalUsedRawMatrial;
use App\Models\MaterialStock;
use App\Models\Product;
use App\Models\Production;
use App\Models\ProductRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductionCreateController extends Controller
{
    public function create()
    {
        $products = Product::whereStatus(true)->get();
        return view('admin.production.create', compact('products'));
    }
    public function material_detail()
    {
        $label = 'Raw Material';

        //for Left side table

    }

    public function store(Request $request)
    {

        $request->validate([
            'product' => 'required',
            'qty' => 'required',
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
                'batch_no' => $request->batch_no
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
            'batch_no' => $sessionData['batch_no']
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
        }
        else {
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
}
