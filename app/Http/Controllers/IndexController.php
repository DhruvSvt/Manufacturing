<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detailsOnIndex()
    {
        $users = User::count();
        $products = Product::count();
        $raw_materials = RawMaterial::count();
        $gifts = Gift::count();
        return view('admin.index', compact('users', 'products', 'raw_materials', 'gifts'));
    }
}
