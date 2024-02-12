<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BrandController extends Controller
{
    public function index()
    {
        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = Brand::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new Brand())->getTable());

        $brands = Brand::when(isset($keyword), function ($query) use ($keyword, $allColumns) {
                $query->where(function ($query) use ($keyword, $allColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }
                });
            })
            ->latest()
            ->paginate($rows);

        return view('admin.brand', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->save();

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
