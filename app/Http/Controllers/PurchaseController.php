<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Gift;
use App\Models\ItemStock;
use App\Models\MaterialStock;
use App\Models\Other;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Purchase;
use App\Models\RawMaterial;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function material_index()
    {
        // return view('admin.purchase.purchase');
        return redirect()->back();
    }

    public function item_index()
    {
        // return view('admin.purchase.purchase');
        return redirect()->back();
    }

    public function material_fetch()
    {
        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = Purchase::where('type', 'App\Models\RawMaterial')->latest()->count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new Purchase())->getTable());
        $allRawMaterialColumns = Schema::getColumnListing((new RawMaterial())->getTable());
        $allSuppliersColumns = Schema::getColumnListing((new Suppliers())->getTable());

        // //for Left side table
        $items = Purchase::with('raw_material', 'supplier')
            ->where('type', 'App\Models\RawMaterial')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allRawMaterialColumns, $allSuppliersColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allRawMaterialColumns, $allSuppliersColumns) {

                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    // searching from supplier
                    $query->orWhereHas('supplier', function ($query) use ($keyword, $allSuppliersColumns) {
                        $query->where(function ($query) use ($keyword, $allSuppliersColumns) {
                            foreach ($allSuppliersColumns as $column) {
                                $query->orWhere($column, 'LIKE', "%$keyword%");
                            }
                        });
                    });

                    // searching from raw_material
                    $query->orWhereHas('raw_material', function ($query) use ($keyword, $allRawMaterialColumns) {
                        $query->where(function ($query) use ($keyword, $allRawMaterialColumns) {
                            foreach ($allRawMaterialColumns as $column) {
                                $query->orWhere($column, 'LIKE', "%$keyword%");
                            }
                        });
                    });
                });
            })
            ->latest()
            ->paginate($rows);

        // $items = Purchase::where('type', 'App\Models\RawMaterial')->latest()->get();
        return view('admin.purchase.material-fetch', compact('items'));
    }

    public function material()
    {
        $masters = RawMaterial::whereStatus(true)->get();
        $brand = Brand::whereStatus(true)->get();
        $suppilers = Suppliers::whereStatus(true)->get();
        $label = "Raw Material";
        $route = route('purchase.materialStore');
        return view('admin.purchase.purchase-master')->with([
            'label' => $label,
            'route' => $route,
            'masters' => $masters,
            'suppilers' => $suppilers,
            'brand' => $brand
        ]);
    }

    public function item_fetch()
    {
        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = Purchase::where('type', 'App\Models\Gift')->latest()->count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new Purchase())->getTable());
        $allGiftsColumns = Schema::getColumnListing((new Gift())->getTable());
        $allSuppliersColumns = Schema::getColumnListing((new Suppliers())->getTable());

        // //for Left side table
        $items = Purchase::with('item', 'supplier')
            ->where('type', 'App\Models\Gift')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allGiftsColumns, $allSuppliersColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allGiftsColumns, $allSuppliersColumns) {

                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    // searching from supplier
                    $query->orWhereHas('supplier', function ($query) use ($keyword, $allSuppliersColumns) {
                        $query->where(function ($query) use ($keyword, $allSuppliersColumns) {
                            foreach ($allSuppliersColumns as $column) {
                                $query->orWhere($column, 'LIKE', "%$keyword%");
                            }
                        });
                    });

                    // searching from gift
                    $query->orWhereHas('item', function ($query) use ($keyword, $allGiftsColumns) {
                        $query->where(function ($query) use ($keyword, $allGiftsColumns) {
                            foreach ($allGiftsColumns as $column) {
                                $query->orWhere($column, 'LIKE', "%$keyword%");
                            }
                        });
                    });
                });
            })
            ->latest()
            ->paginate($rows);

        // $items = Purchase::where('type', 'App\Models\Gift')->latest()->get();
        return view('admin.purchase.item-fetch', compact('items'));
    }

    public function item()
    {
        $masters = Gift::whereStatus(true)->get();
        $brand = Brand::whereStatus(true)->get();
        $suppilers = Suppliers::whereStatus(true)->get();
        $label = "Item";
        $route = route('purchase.itemStore');
        return view('admin.purchase.purchase-master')->with([
            'label' => $label,
            'route' => $route,
            'masters' => $masters,
            'suppilers' => $suppilers,
            'brand' => $brand
        ]);
    }
    public function product()
    {
        $masters = Product::whereStatus(true)->get();
        $brand = Brand::whereStatus(true)->get();
        $suppilers = Suppliers::whereStatus(true)->get();
        $label = "Product";
        $route = route('purchase.productStore');
        // $route = route('purchase.productStore');
        return view('admin.purchase.purchase-master')->with([
            'label' => $label,
            'route' => $route,
            'masters' => $masters,
            'brand' => $brand,
            'suppilers' => $suppilers
        ]);
    }

    public function other()
    {
        $suppilers = Suppliers::whereStatus(true)->get();
        $brand = Brand::whereStatus(true)->get();
        $label = "Other";
        $route = route('purchase.otherStore');
        // $route = route('purchase.productStore');
        return view('admin.purchase.purchase-other')->with([
            'label' => $label,
            'route' => $route,
            'brand' => $brand,
            'suppilers' => $suppilers
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function materialStore(Request $request)
    {


        $request->validate([
            'modal_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'bill_qty' => 'required',
            'price' => 'required',
            // 'batch_no' => 'unique:purchases,batch_no',

        ]);
        if ($request->expiry_date == null) {
            $request->expiry_date = date('Y-m-d', strtotime('+20 years'));
        }

        // Create for Purchase

        $purchase = new Purchase([
            'type' => 'App\Models\RawMaterial',
            'modal_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'bill_qty' => $request->bill_qty,
            'price' => $request->price,
            'remark' => $request->remark,
            'batch_no' => $request->batch_no,
            'expiry_date' => $request->expiry_date
        ]);
        //dd($purchase->all());
        $purchase->save();

        // getting id from purchase table for stocks

        // Create for Stocks
        $stock = new MaterialStock([
            'purchase_id' => $purchase->id,
            'raw_material_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'quantity' => $request->quantity,
            'bill_no' => $request->bill_no,
            'bill_date' => $request->bill_date
        ]);

        $stock->save();

        // redirect to the route
        return redirect()->back()->with('success', 'Successfully Purchased !!');
    }
    public function itemStore(Request $request)
    {
        $request->validate([
            'modal_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            // 'batch_no' => 'unique:purchases,batch_no',

        ]);
        if ($request->expiry_date == null) {
            $request->expiry_date = date('Y-m-d', strtotime('+20 years'));
        }

        // Create for Purchase
        $item = new Purchase([
            'type' => 'App\Models\Gift',
            'modal_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'bill_qty' => $request->bill_qty,
            'price' => $request->price,
            'batch_no' => $request->batch_no,
            'expiry_date' => $request->expiry_date
        ]);


        $item->save();

        // getting id from purchase table for ItemStocks

        // Create for Stocks
        $stock = new ItemStock([
            'purchase_id' => $item->id,
            'item_id' =>  $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'quantity' => $request->quantity,
        ]);

        $stock->save();

        // redirect to the route
        return redirect()->back()->with('success', 'Successfully Purchased !!');
    }
    public function productStore(Request $request)
    {
        $request->validate([
            'modal_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            // 'batch_no' => 'unique:purchases,batch_no',

        ]);
        if ($request->expiry_date == null) {
            $request->expiry_date = date('Y-m-d', strtotime('+20 years'));
        }

        // Create for Purchase
        $product = new Purchase([
            'type' => 'App\Models\Product',
            'modal_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'batch_no' => $request->batch_no,
            'bill_qty' => $request->bill_qty,
            'expiry_date' => $request->expiry_date
        ]);

        $product->save();

        // getting id from purchase table for ProductStocks

        // Create for Stocks
        $stock = new ProductStock([
            'purchase_id' => $product->id,
            'product_type' => 'App\Models\Purchase',
            'product_id' =>  $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'price' => $request->price,
            'batch_no' => $request->batch_no,
            'expiry_date' => $request->expiry_date,
            'quantity' => $request->quantity,
            'bill_no' => $request->bill_no,
            'bill_date' => $request->bill_date
        ]);

        $stock->save();

        // redirect to the route
        return redirect()->back()->with('success', 'Successfully Purchased !!');
    }
    public function otherStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',

        ]);
        if ($request->expiry_date == null) {
            $request->expiry_date = date('Y-m-d', strtotime('+20 years'));
        }
        // Create for Purchase
        $other = new Other([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'remark' => $request->remark,
            'bill_qty' => $request->bill_qty,
            'expiry_date' => $request->expiry_date
        ]);

        $other->save();

        return redirect()->back()->with('success', 'Successfully Purchased !!');
    }
}
