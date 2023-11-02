<?php

namespace App\Http\Controllers;

use App\Models\MaterialStock;
use Illuminate\Http\Request;

class StockAlertController extends Controller
{

    public function index()
    {
        $stocks = MaterialStock::groupBy('raw_material_id')
            ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
            ->havingRaw('sum(quantity) < 250')
            ->where('expiry_date', '>', \Carbon\Carbon::now())
            ->get();
        // return $stocks;
        return view('admin.stock-alert', compact('stocks'));
    }
}
