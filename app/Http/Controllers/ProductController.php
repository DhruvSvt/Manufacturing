<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRawMaterial;
use App\Models\RawMaterial;
use App\Models\Unit;
use Illuminate\Http\Request;
use PDO;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('raw_material')->get();
        return view('admin.product', compact('products'));
    }

    public function rawMaterials()
    {
        $selected_materials = request()->selected_raw_materials ?? [];
        $raw_materials = RawMaterial::whereNotIn('id', $selected_materials)->get();
        return response()->json($raw_materials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $raw_materials = RawMaterial::whereStatus(true)->get();
        $units = Unit::whereStatus(true)->get();
        return view('admin.product-create', compact('raw_materials','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return request()->all();
        $product = new Product;
        $product->name = request()->name;
        $product->price = request()->price;
        $product->save();

        $rawProducts = json_decode(request()->raw_materials);
        foreach ($rawProducts as $item) {
            $raw_material = new ProductRawMaterial;
            $raw_material->product_id = $product->id;
            $raw_material->raw_material_id = $item->id;
            $raw_material->qty = $item->qty;
            $raw_material->save();
        }

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return request()->all();
        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $raw_materials = RawMaterial::whereStatus(true)->get();
        $product = Product::with('raw_material')->find($product);

        return view('admin.product-edit', compact('product', 'raw_materials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $product = Product::findOrFail($id);

        $product->name = request()->name;
        $product->price = request()->price;
        $product->save();

        //removing old
        foreach ($product->raw_material as $raw_material) {
            ProductRawMaterial::where(['raw_material_id' => $raw_material->id, 'product_id' => $product->id])->delete();
        }

        //adding new
        $rawProducts = json_decode(request()->raw_materials);
        foreach ($rawProducts as $item) {
            $raw_material = new ProductRawMaterial;
            $raw_material->product_id = $product->id;
            $raw_material->raw_material_id = $item->id;
            $raw_material->qty = $item->qty;
            $raw_material->save();
        }

        return redirect()->route('product.index');
    }

    public function status(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->status = $request->status;
        $product->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
