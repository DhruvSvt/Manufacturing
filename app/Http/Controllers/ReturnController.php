<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Production;
use App\Models\ProductStock;
use App\Models\ReturnGood;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function good_return()
    {
        $returns = ReturnGood::all();
        return view('admin.returns.good-return', compact('returns'));
    }

    public function good_return_create()
    {
        $suppilers = Suppliers::all();
        $products = Product::all();
        return view('admin.returns.good-return-create', compact('suppilers', 'products'));
    }

    public function good_return_store(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
            'supplier_id' => 'required',
            'type' => 'required',
            'batch' => 'required',
            'builty' => 'required',
            'transport' => 'required',
            'dispatch' => 'required',
            'date_of_receipt' => 'required',
            'quantity' => 'required',
            'receipt' => 'required',
        ]);

        $stock = Production::where('batch_no',$request->batch)->first();

        if($request->product_id == $stock->product_id )
        {
            $expiry_date = $stock->expiry_date;
            $current_date = \Carbon\Carbon::now();

            if($expiry_date > $current_date){
                
                // Update in ProductionStock
                $product_stock = ProductStock::where('purchase_id',$stock->id)->first();
                $product_stock->quantity += $request->quantity;
                $product_stock->save();
            }

            ReturnGood::create($request->post());

            return redirect()->route('good-return')->with('success', 'Return Good Create Successfully.');
        }
        else{
            return redirect()->back()->with('error', 'Your Product and Batch No. not matches with our records !!');
        }

    }
}
