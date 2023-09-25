<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function material_index()
    {
        $label = 'Raw Material';
        $master = Stock::all();
        return view('admin.stock.stock-master',)->with([
            'label' => $label,
            'master' => $master
        ]);
    }
}
