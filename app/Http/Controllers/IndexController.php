<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\User;
use App\Models\SaleInvoice;
use DB;
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
        $sale = SaleInvoice::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amt) As sale'))
        ->where('created_at', '>', now()->subDays(30)->endOfDay())
            ->groupBy('date')
            ->get();
        return view('admin.index', compact('users', 'products', 'raw_materials', 'gifts', 'sale'));
    }
}
