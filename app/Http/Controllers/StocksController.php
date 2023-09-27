<?php

namespace App\Http\Controllers;

use App\Models\ItemStock;
use App\Models\MaterialStock;
use App\Models\RawMaterial;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function stock_details()
    {

        //  Raw Material Information
        $raw_material = MaterialStock::all();
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
        $master = MaterialStock::all();
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

    public function material_detail()
    {
        $label = 'Raw Material';        
        //for Right side table 
        $check_expiring = MaterialStock::groupBy('raw_material_id')
            ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
            ->where('expiry_date', '<=', \Carbon\Carbon::now())
            ->get();

        //for Left side table 
        $master = MaterialStock::groupBy('raw_material_id')
            ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
            ->where('expiry_date', '>', \Carbon\Carbon::now())
            ->get();
            
        return view('admin.stock.stock-material',)->with([
            'label' => $label,
            'master' => $master,
            'check_expiring' => $check_expiring
        ]);
    }

    public function material_detail_id($raw_material_id)
    {
        $label = 'Raw Material';

        // Fetch entries with matching raw_material_id
        $raw_materials = MaterialStock::where('raw_material_id', $raw_material_id)->get();

        return view('admin.stock.stock-material-detail', compact('raw_materials', 'label'));
    }

    public function item_detail()
    {
        $label = 'Item';        
        //for Right side table 
        $check_expiring = ItemStock::groupBy('item_id')
            ->selectRaw('sum(quantity) as total_quantity, item_id')
            ->where('expiry_date', '<=', \Carbon\Carbon::now())
            ->get();

        //for Left side table 
        $master = ItemStock::groupBy('item_id')
            ->selectRaw('sum(quantity) as total_quantity, item_id')
            ->where('expiry_date', '>', \Carbon\Carbon::now())
            ->get();
            
        return view('admin.stock.stock-material',)->with([
            'label' => $label,
            'master' => $master,
            'check_expiring' => $check_expiring
        ]);
    }

    public function item_detail_id($raw_material_id)
    {
        $label = 'Item';

        // Fetch entries with matching raw_material_id
        $raw_materials = MaterialStock::where('item_id', $raw_material_id)->get();

        return view('admin.stock.stock-material-detail', compact('raw_materials', 'label'));
    }
}
