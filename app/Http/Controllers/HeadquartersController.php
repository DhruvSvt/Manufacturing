<?php

namespace App\Http\Controllers;

use App\Models\Headquarters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HeadquartersController extends Controller
{
    public function index()
    {
        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = Headquarters::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new Headquarters())->getTable());

        $headquarters = Headquarters::when(isset($keyword), function ($query) use ($keyword, $allColumns) {
                $query->where(function ($query) use ($keyword, $allColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }
                });
            })
            ->latest()
            ->paginate($rows);

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
