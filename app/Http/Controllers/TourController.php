<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeOrderGift;
use App\Models\EmployeeOrderProduct;
use App\Models\TourPrograme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TourController extends Controller
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
            $rows = TourPrograme::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new TourPrograme())->getTable());
        $emps = Schema::getColumnListing((new Employee())->getTable());

        $tours = TourPrograme::orWhereHas('employee')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $emps) {
                $query->where(function ($query) use ($keyword, $allColumns, $emps) {

                    $query->orWhere(function ($query) use ($keyword, $allColumns) {
                        // Dynamically construct the search query
                        foreach ($allColumns as $column) {
                            $query->orWhere($column, 'LIKE', "%$keyword%");
                        }
                    });

                    $query->orWhereHas('employee', function ($query) use ($keyword, $emps) {
                        $query->where(function ($query) use ($keyword, $emps) {
                            foreach ($emps as $column) {
                                $query->orWhere($column, 'LIKE', "%$keyword%");
                            }
                        });
                    });
                });
            })
            ->latest()
            ->paginate($rows);

        $emps = Employee::whereStatus(true)->get();

        return view('admin.tour.tour-create', compact('emps', 'tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'tour_date' => 'required',
            'employee_id' => 'required',
            'start_location' => 'required',
            'end_location' => 'required',
        ]);

        TourPrograme::create($request->post());

        return redirect()->route('tour.index')->with('success', 'Successfully Tour Assigned !!');
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
        //
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
        //
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

    public function product_fetch($id)
    {
        $product_lists = EmployeeOrderProduct::where('visit_id', $id)->get();
        return view('admin.tour.product-fetch', compact('product_lists'));
    }

    public function gift_fetch($id)
    {
        $gift_lists = EmployeeOrderGift::where('visit_id', $id)->get();
        return view('admin.tour.gift-fetch', compact('gift_lists'));
    }
}
