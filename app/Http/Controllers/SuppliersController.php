<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::orderBy('created_at', 'desc')->get();
        return view('admin.supplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier-create');
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
            'name' => 'required',
            'phone' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'gst' => 'required',
            'dl' => 'required',
        ]);

        Suppliers::create($request->post());

        return redirect()->route('supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Suppliers::find($id);
        return view('admin.supplier-edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = Suppliers::find($id);
        $request->validate([
            'name' => 'required',
            'phone' => 'required | max:10',
            'company_name' => 'required',
            'address' => 'required',
        ]);

        $supplier->fill($request->post())->save();

        return redirect()->route('supplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppliers $suppliers)
    {
        //
    }

    public function status(Request $request)
    {
        $supplier = Suppliers::findOrFail($request->supplier_id);
        $supplier->status = $request->status;
        $supplier->save();

        return redirect()->back();
    }
}
