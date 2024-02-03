<?php

namespace App\Http\Controllers;

use App\Models\Packing;
use App\Models\PackingStock;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class PackingStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packing = PackingStock::groupBy('product_id')
            ->selectRaw('sum(qty) as total_qty, product_id')
            ->get();
        return view('admin.packing.packing-stock', compact('packing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packings = Packing::whereStatus(true)->get();
        $suppliers = Suppliers::whereStatus(true)->get();
        return view('admin.packing.packing-stock-create', compact('packings', 'suppliers'));
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
            'product_id' => 'required',
            'supplier_id' => 'required',
            'qty' => 'required',
            'rate' => 'required'
        ]);

        PackingStock::create($request->post());

        return redirect()->route('packing-stock.index')->with('success', 'Packing stock was successfully creared !!');
    }


    public function packingStockDetail($product_id)
    {

        // Fetch entries with matching raw_material_id
        $packings = PackingStock::where('product_id', $product_id)->get();
        return view('admin.packing.packing-stock-detail', compact('packings'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackingStock  $packingStock
     * @return \Illuminate\Http\Response
     */
    public function show(PackingStock $packingStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackingStock  $packingStock
     * @return \Illuminate\Http\Response
     */
    public function edit(PackingStock $packingStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackingStock  $packingStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackingStock $packingStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackingStock  $packingStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackingStock $packingStock)
    {
        //
    }
}
