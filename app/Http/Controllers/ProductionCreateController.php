<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Production;
use Illuminate\Http\Request;

class ProductionCreateController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('admin.production.create',compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required',
            'qty' => 'required',
            'batch_no' => 'required'
        ]);

        $production = new Production([
            'product_id' => $request->product,
            'qty' => $request->qty,
            'batch_no' => $request->batch_no
        ]);

        dd($production);
    }
}
