<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand',compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->save()  ;

        return redirect()->route('brand');
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        $brand->name = $request->name;

        $brand->save();

        return redirect()->route('brand');
    }

    public function status(Request $request)
    {
        $brand = Brand::findOrFail($request->brand_id);
        $brand->status = $request->status;
        $brand->save();

        return redirect()->back();
    }
}
