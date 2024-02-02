<?php

namespace App\Http\Controllers;

use App\Models\Packing;
use App\Models\Product;
use Illuminate\Http\Request;

class PackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packings = Packing::all();
        return view('admin.packing.packing', compact('packings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::whereStatus(true)->get();
        return view('admin.packing.packing-create', compact('products'));
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
            'size' => 'required',
            'rate' => 'required'
        ]);

        Packing::create($request->post());

        return redirect()->route('packing.index')->with('success', 'Packing has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Packing  $packing
     * @return \Illuminate\Http\Response
     */
    public function show(Packing $packing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Packing  $packing
     * @return \Illuminate\Http\Response
     */
    public function edit(Packing $packing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Packing  $packing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Packing $packing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Packing  $packing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Packing $packing)
    {
        //
    }

    public function status(Request $request)
    {
        $packing = Packing::findOrFail($request->packing_id);
        $packing->status = $request->status;
        $packing->save();

        return redirect()->back();
    }
}
