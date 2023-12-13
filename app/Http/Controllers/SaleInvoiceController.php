<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\SaleInvoice;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = SaleInvoice::all();
        return view('admin.sale-invoice.sale-invoice', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $party = Suppliers::whereStatus(true)->get();
        $products = Product::whereStatus(true)->get();
        return view('admin.sale-invoice.create', compact('party', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'place' => 'required',
            'product_id' => 'required',
            'qty' => 'required | min:1',
            'rate' => 'required | min:1',
        ]);

        $qty = $request->qty;

        $checkStock = ProductStock::where('product_id', $request->product_id)
        ->where('expiry_date','>',\Carbon\Carbon::now())
        ->get();
        
        $total_stock = 0;

        foreach ($checkStock as $item) {
            $total_stock += $item->quantity;
        }

        if ($total_stock > $qty) {

            $sale = new SaleInvoice;
            $sale->supplier_id = $request->supplier_id;
            $sale->place = $request->place;
            $sale->product_id = $request->product_id;
            $sale->qty = $qty;
            $sale->rate = $request->rate;
            // -----cal. total amount-----
            $sale->total_amt = $request->rate * $qty;
            $sale->save();

            foreach ($checkStock as $item) {
                if ($qty > 0) {
                    if ($item->quantity >= $qty) {
                        $item->quantity -= $qty;
                        $qty = 0;
                        $item->save();
                    } else {
                        $qty -= $item->quantity;
                        $item->quantity = 0;
                        $item->save();
                    }
                } else {
                    break;
                }
            }
            return redirect()->route('sale.index')->with('success', 'Data saved successfully !!');
        } else {
            return redirect()->back()->with('error', 'Insufficient Stock You need ' . ($qty - $total_stock) . ' more units to complete this');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(SaleInvoice $saleInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleInvoice $saleInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleInvoice $saleInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleInvoice $saleInvoice)
    {
        //
    }
}
