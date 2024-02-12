<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = Unit::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new Unit())->getTable());

        $units = Unit::with('parent')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns) {
                $query->where(function ($query) use ($keyword, $allColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }
                });
            })
            ->latest()
            ->paginate($rows);

        return view('admin.unit', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::whereStatus(true)->get();
        return view('admin.unit-create', compact('units'));
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
            'short_name' => 'required',
            'full_name' => 'required',
        ]);

        Unit::create($request->post());

        return redirect()->route('unit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units = Unit::all();
        $unit = Unit::findOrFail($id);
        return view('admin.unit-edit', compact('unit', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unit = Unit::find($id);
        $request->validate([
            'short_name' => 'required',
            'full_name' => 'required',
        ]);

        $unit->fill($request->post())->save();

        return redirect()->route('unit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }

    public function status(Request $request)
    {
        $unit = Unit::findOrFail($request->unit_id);
        $unit->status = $request->status;
        $unit->save();

        return redirect()->back();
    }
}
