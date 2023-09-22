<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use App\Models\Unit;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raw_material = RawMaterial::latest()->get();
        return view('admin.raw-material', compact('raw_material'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::whereStatus(true)->get();
        return view('admin.raw-material-create', compact('units'));
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
            'price' => 'required',
            'unit' => 'required',
        ]);

        $raw_material = new RawMaterial;
        $raw_material->name = $request->name;
        $raw_material->price = $request->price;
        $raw_material->unit = $request->unit;
        $raw_material->save();

        return redirect()->route('raw-material');
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
        $units = Unit::whereStatus(true)->get();
        $raw_material = RawMaterial::find($id);
        return view('admin.raw-material-edit', compact('raw_material','units'));
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
        $raw_material = RawMaterial::find($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'unit' => 'required',
        ]);

        $raw_material->name = $request->name;
        $raw_material->price = $request->price;
        $raw_material->unit = $request->unit;
        $raw_material->save();

        return redirect()->route('raw-material');
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

    public function status(Request $request)
    {
        $raw_material = RawMaterial::findOrFail($request->raw_material_id);
        $raw_material->status = $request->status;
        $raw_material->save();  

        return redirect()->back();  
    }
}
