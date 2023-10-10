<?php

namespace App\Http\Controllers;

use App\Models\Headquarters;
use Illuminate\Http\Request;

class HeadquartersController extends Controller
{
    public function index()
    {
        $headquarters = Headquarters::all();
        return view('admin.headquarters', compact('headquarters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'state' => 'required',
            'headquarter' => 'required',
            'region' => 'required',
        ]);

        $headquarter = new Headquarters;
        $headquarter->state = $request->state;
        $headquarter->headquarter = $request->headquarter;
        $headquarter->region = $request->region;

        $headquarter->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $headquarter = Headquarters::findOrFail($id);

        $request->validate([
            'state' => 'required',
            'headquarter' => 'required',
            'region' => 'required',
        ]);

        $headquarter->state = $request->state;
        $headquarter->headquarter = $request->headquarter;
        $headquarter->region = $request->region;

        $headquarter->save();

        return redirect()->back();
    }

    public function status(Request $request)
    {
        $headquarter = Headquarters::findOrFail($request->headquarter_id);
        $headquarter->status = $request->status;
        $headquarter->save();

        return redirect()->back();
    }
}
