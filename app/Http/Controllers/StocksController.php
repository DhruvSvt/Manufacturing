<?php

namespace App\Http\Controllers;

use App\Models\ItemStock;
use App\Models\RawMaterial;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function stock_details()
    {

        //  Raw Material Information
        $raw_material = Stock::all();
        $total_raw_material = 0;
        foreach ($raw_material as $rm) {
            if (\Carbon\Carbon::parse($rm->expiry_date)->gt(\Carbon\Carbon::now())) {
                $total_raw_material = $total_raw_material + $rm->quantity;
            }
        }

        //  Item Information
        $item = ItemStock::all();
        $total_item = 0;
        foreach ($item as $item) {
            if (\Carbon\Carbon::parse($item->expiry_date)->gt(\Carbon\Carbon::now())) {
                $total_item = $total_item + $item->quantity;
            }
        }
        return view('admin.stock.stock-detail', compact('total_raw_material', 'total_item'));
    }

    public function material_index()
    {
        $label = 'Raw Material';
        $master = Stock::all();
        return view('admin.stock.stock-material',)->with([
            'label' => $label,
            'master' => $master,
        ]);
    }

    public function item_index()
    {
        $label = 'Item';
        $master = ItemStock::all();
        return view('admin.stock.stock-item',)->with([
            'label' => $label,
            'master' => $master,
        ]);
    }
}
