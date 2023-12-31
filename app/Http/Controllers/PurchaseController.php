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
            'price' => 'required',
            'batch_no' => 'unique:purchases,batch_no',
            'expiry_date' => 'required'
        ]);


        // Create for Purchase
        $purchase = new Purchase([
            'type' => 'App\Models\RawMaterial',
            'modal_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'remark' => $request->remark,
            'batch_no' => $request->batch_no,
            'expiry_date' => $request->expiry_date
        ]);
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
            'batch_no' => 'unique:purchases,batch_no',
            'expiry_date' => 'required'
        ]);


        // Create for Purchase
        $item = new Purchase([
            'type' => 'App\Models\Gift',
            'modal_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
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
            'batch_no' => 'unique:purchases,batch_no',
            'expiry_date' => 'required'
        ]);

        // Create for Purchase
        $product = new Purchase([
            'type' => 'App\Models\Product',
            'modal_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'batch_no' => $request->batch_no,
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
            'expiry_date' => 'required'
        ]);

        // Create for Purchase
        $other = new Other([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'remark' => $request->remark,
            'expiry_date' => $request->expiry_date
        ]);

        $other->save();

        return redirect()->back()->with('success', 'Successfully Purchased !!');
    }
}
