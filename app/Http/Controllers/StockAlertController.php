<?php

namespace App\Http\Controllers;

use App\Models\MaterialStock;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class StockAlertController extends Controller
{

    public function index()
    {
        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = MaterialStock::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new MaterialStock())->getTable());
        $allRawMaterialColumns = Schema::getColumnListing((new RawMaterial())->getTable());

        // //for Left side table
        $stocks = MaterialStock::with('raw_material')
            ->where('expiry_date', '>', \Carbon\Carbon::now())
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allRawMaterialColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allRawMaterialColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    // searching from raw material
                    $query->orWhereHas('raw_material', function ($query) use ($keyword, $allRawMaterialColumns) {
                        $query->where(function ($query) use ($keyword, $allRawMaterialColumns) {
                            foreach ($allRawMaterialColumns as $column) {
                                $query->orWhere($column, 'LIKE', "%$keyword%");
                            }
                        });
                    });

                    // Convert the date format and search
                    $query->orWhereRaw("DATE_FORMAT(created_at, '%d-%m-%Y') LIKE ?", ["%$keyword%"]);
                });
            })
            ->groupBy('raw_material_id')
            ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
            ->havingRaw('sum(quantity) < 250')
            ->paginate($rows);

        // $stocks = MaterialStock::groupBy('raw_material_id')
        //     ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
        //     ->havingRaw('sum(quantity) < 250')
        //     ->where('expiry_date', '>', \Carbon\Carbon::now())
        //     ->get();
        // return $stocks;
        return view('admin.stock-alert', compact('stocks'));
    }
}
