<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\ItemStock;
use App\Models\MaterialStock;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'expiry_date' => 'required'
        ]);


        // Create for Purchase
        $purchase = new Purchase([
            'type' => 'App\Models\RawMaterial',
            'modal_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date
        ]);

        $purchase->save();

        // getting id from purchase table for stocks      

        // Create for Stocks
        $stock = new MaterialStock([
            'purchase_id' => $purchase->id,
            'raw_material_id' => $request->modal_id,
            'expiry_date' => $request->expiry_date,
            'quantity' => $request->quantity,
        ]);

        $stock->save();

        // redirect to the route 
        return redirect()->route('material-index');
    }
    public function itemStore(Request $request)
    {
        $request->validate([
            'modal_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'expiry_date' => 'required'
        ]);


        // Create for Purchase
        $item = new Purchase([
            'type' => 'App\Models\Gift',
            'modal_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date
        ]);


        $item->save();

        // getting id from purchase table for ItemStocks      

        // Create for Stocks
        $stock = new ItemStock([
            'purchase_id' => $item->id,
            'expiry_date' => $request->expiry_date,
            'quantity' => $request->quantity,
        ]);

        $stock->save();

        // redirect to the route 
        return redirect()->route('item-index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function material()
    {
        $masters = RawMaterial::all();
        $suppilers = Suppliers::all();
        $label = "Raw Material";
        $route = route('purchase.materialStore');
        return view('admin.purchase.purchase-master', compact('label', 'route', 'masters', 'suppilers'));
    }

    public function item()
    {
        $masters = Gift::all();
        $suppilers = Suppliers::all();
        $label = "Item";
        $route = route('purchase.itemStore');
        return view('admin.purchase.purchase-master')->with([
            'label' => $label,
            'route' => $route,
            'masters' => $masters,
            'suppilers' => $suppilers
        ]);
    }
}
