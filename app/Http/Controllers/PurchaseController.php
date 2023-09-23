<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\RawMaterial;
use App\Models\Stock;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.purchase.purchase');
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
            'type' => 'raw material',
            'modal_id' => $request->modal_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date
        ]);
        
        dd($purchase);
        // $purchase->save();

        // // getting id from purchase table for stocks      

        // // Create for Stocks
        // $stock = new Stock([
        //     'purchase_id' => $purchase->id,
        //     'expiry_date' => $request->expiry_date,
        //     'quantity' => $request->quantity,
        // ]);

        // $stock->save();

        // // redirect to the route 
        // return redirect()->route('purchase');
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
        $raw_material = RawMaterial::all();
        $suppilers = Suppliers::all();
        return view('admin.purchase.purchase-raw-material', compact('raw_material', 'suppilers'));
    }
}
