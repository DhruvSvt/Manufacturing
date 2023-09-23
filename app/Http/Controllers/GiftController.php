<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts = Gift::orderBy('created_at', 'desc')->get();
        return view('admin.gift', compact('gifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::whereStatus(true)->get();
        return view('admin.gift-create', compact('units'));
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
            'image' => 'required|image|max:2048'
        ]);

        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $fileName);

        $gift = new Gift;
        $gift->name = $request->name;
        $gift->price = $request->price;
        $gift->unit = $request->unit;
        $gift->image = $fileName;
        $gift->save();

        return redirect()->route('gift');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function show(Gift $gift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units = Unit::whereStatus(true)->get();
        $gift = Gift::find($id);
        return view('admin.gift-edit', compact('gift','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gift = Gift::find($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'unit' => 'required',
        ]);

        $old_image = $gift->image;

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $gift->image = $fileName;
            if ($gift->image) {
                Storage::delete('public/images/' . $old_image);
            }
        }
        $gift->name = $request->name;
        $gift->price = $request->price;
        $gift->unit = $request->unit;
        
        $gift->save();

        return redirect()->route('gift');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gift $gift)
    {
        //
    }
    public function status(Request $request)
    {
        $gift = Gift::findOrFail($request->gift_id);
        $gift->status = $request->status;
        $gift->save();

        return redirect()->back();
    }
}
