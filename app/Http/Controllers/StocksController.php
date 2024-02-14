<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\ItemStock;
use App\Models\MaterialStock;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Purchase;
use App\Models\RawMaterial;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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

        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = MaterialStock::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new MaterialStock())->getTable());
        $allRawMaterialColumns = Schema::getColumnListing((new RawMaterial())->getTable());
        $allPurchaseColumns = Schema::getColumnListing((new Purchase())->getTable());

        // //for Left side table
        $master = MaterialStock::with('raw_material', 'purchase')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allRawMaterialColumns, $allPurchaseColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allRawMaterialColumns, $allPurchaseColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    // Dynamically construct the search query for Product
                    foreach ($allRawMaterialColumns as $column) {
                        $query->orWhereHas('raw_material', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }

                    // Dynamically construct the search query for Product
                    foreach ($allPurchaseColumns as $column) {
                        $query->orWhereHas('purchase', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }
                });
            })
            ->groupBy('raw_material_id')
            ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
            ->where('expiry_date', '>', \Carbon\Carbon::now())
            ->latest()
            ->paginate($rows);

        //for Right side table
        $check_expiring = MaterialStock::with('raw_material', 'purchase')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allRawMaterialColumns, $allPurchaseColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allRawMaterialColumns, $allPurchaseColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    // Dynamically construct the search query for Product
                    foreach ($allRawMaterialColumns as $column) {
                        $query->orWhereHas('raw_material', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }

                    // Dynamically construct the search query for Product
                    foreach ($allPurchaseColumns as $column) {
                        $query->orWhereHas('purchase', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }
                });
            })
            ->groupBy('raw_material_id')
            ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
            ->where('expiry_date', '<=', \Carbon\Carbon::now())
            ->latest()
            ->paginate($rows);


        // $check_expiring = MaterialStock::groupBy('raw_material_id')
        //     ->selectRaw('sum(quantity) as total_quantity, raw_material_id')
        //     ->where('expiry_date', '<=', \Carbon\Carbon::now())
        //     ->get();


        // $master = MaterialStock::groupBy('raw_material_id')
        //     ->selecRaw('sum(quantity) as total_quantity, raw_material_id')
        //     ->where('expiry_date', '>', \Carbon\Carbon::now())
        //     ->get();

        return view('admin.stock.stock-material',)->with([
            'label' => $label,
            'master' => $master,
            'check_expiring' => $check_expiring
        ]);
    }

    public function material_detail_id($raw_material_id)
    {
        $label = 'Raw Material';

        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = MaterialStock::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new MaterialStock())->getTable());
        $allPurchaseColumns = Schema::getColumnListing((new Purchase())->getTable());
        $allRawMaterialColumns = Schema::getColumnListing((new RawMaterial())->getTable());

        // //for Left side table
        $raw_materials = MaterialStock::with('purchase', 'raw_material')->where('raw_material_id', $raw_material_id, $allPurchaseColumns)
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allRawMaterialColumns, $allPurchaseColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allRawMaterialColumns , $allPurchaseColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    foreach ($allRawMaterialColumns as $column) {
                        $query->orWhereHas('raw_material', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }

                    foreach ($allPurchaseColumns as $column) {
                        $query->orWhereHas('purchase', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }
                });
            })
            ->latest()
            ->paginate($rows);

        // Fetch entries with matching raw_material_id
        // $raw_materials = MaterialStock::with('purchase')->where('raw_material_id', $raw_material_id)->get();
        return view('admin.stock.stock-material-detail', compact('raw_materials', 'label'));
    }

    public function item_detail()
    {
        $label = 'Gifts';

        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = ItemStock::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new ItemStock())->getTable());
        $allGiftColumns = Schema::getColumnListing((new Gift())->getTable());
        $allPurchaseColumns = Schema::getColumnListing((new Purchase())->getTable());

        // //for Left side table
        $master = ItemStock::with('item', 'purchase')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allGiftColumns, $allPurchaseColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allGiftColumns, $allPurchaseColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    foreach ($allGiftColumns as $column) {
                        $query->orWhereHas('item', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }

                    foreach ($allPurchaseColumns as $column) {
                        $query->orWhereHas('purchase', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }
                });
            })
            ->groupBy('item_id')
            ->selectRaw('sum(quantity) as total_quantity, item_id')
            ->where('expiry_date', '>', \Carbon\Carbon::now())
            ->latest()
            ->paginate($rows);

        // //for Right side table
        $check_expiring = ItemStock::with('item', 'purchase')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allGiftColumns, $allPurchaseColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allGiftColumns, $allPurchaseColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    foreach ($allGiftColumns as $column) {
                        $query->orWhereHas('item', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }

                    foreach ($allPurchaseColumns as $column) {
                        $query->orWhereHas('purchase', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }
                });
            })
            ->groupBy('item_id')
            ->selectRaw('sum(quantity) as total_quantity, item_id')
            ->where('expiry_date', '<=', \Carbon\Carbon::now())
            ->latest()
            ->paginate($rows);



        //for Right side table
        // $check_expiring = ItemStock::groupBy('item_id')
        //     ->selectRaw('sum(quantity) as total_quantity, item_id')
        //     ->where('expiry_date', '<=', \Carbon\Carbon::now())
        //     ->get();

        //for Left side table
        // $master = ItemStock::groupBy('item_id')
        //     ->selectRaw('sum(quantity) as total_quantity, item_id')
        //     ->where('expiry_date', '>', \Carbon\Carbon::now())
        //     ->get();

        return view('admin.stock.stock-item',)->with([
            'label' => $label,
            'master' => $master,
            'check_expiring' => $check_expiring
        ]);
    }

    public function item_detail_id($item_id)
    {
        $label = 'Item';

        // Fetch entries with matching raw_material_id
        $items = ItemStock::with('purchase')->where('item_id', $item_id)->get();

        return view('admin.stock.stock-item-detail', compact('items', 'label'));
    }


    public function product_detail()
    {
        $label = 'Product';

        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = ProductStock::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new ProductStock())->getTable());
        $allProductColumns = Schema::getColumnListing((new Product())->getTable());

        // //for Left side table
        $master = ProductStock::with('product')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allProductColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allProductColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    foreach ($allProductColumns as $column) {
                        $query->orWhereHas('product', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }
                });
            })
            ->groupBy('product_id')
            ->selectRaw('sum(quantity) as total_quantity, product_id')
            ->where('expiry_date', '>', \Carbon\Carbon::now())
            ->latest()
            ->paginate($rows);

        // //for Right side table
        $check_expiring = ProductStock::with('product')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allProductColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allProductColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    foreach ($allProductColumns as $column) {
                        $query->orWhereHas('product', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }
                });
            })
            ->groupBy('product_id')
            ->selectRaw('sum(quantity) as total_quantity, product_id')
            ->where('expiry_date', '<=', \Carbon\Carbon::now())
            ->latest()
            ->paginate($rows);

        //for Right side table
        // $check_expiring = ProductStock::groupBy('product_id')
        //     ->selectRaw('sum(quantity) as total_quantity, product_id')
        //     ->where('expiry_date', '<=', \Carbon\Carbon::now())
        //     ->get();

        //for Left side table
        // $master = ProductStock::groupBy('product_id')
        //     ->selectRaw('sum(quantity) as total_quantity, product_id')
        //     ->where('expiry_date', '>', \Carbon\Carbon::now())
        //     ->get();

        return view('admin.stock.stock-product',)->with([
            'label' => $label,
            'master' => $master,
            'check_expiring' => $check_expiring
        ]);
    }

    public function product_detail_id($product_id)
    {
        $label = 'Product';

        // Fetch entries with matching raw_material_id
        $products = ProductStock::where('product_id', $product_id)->get();

        return view('admin.stock.stock-product-detail', compact('products', 'label'));
    }
}
