<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function good_return()
    {
        return view('admin.returns.good-return');
    }

    public function good_return_create()
    {
        $suppilers = Suppliers::all();
        $products = Product::all();
        return view('admin.returns.good-return-create',compact('suppilers','products'));
    }
}
