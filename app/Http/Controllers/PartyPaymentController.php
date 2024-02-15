<?php

namespace App\Http\Controllers;

use App\Models\PartyPayment;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use function PHPSTORM_META\type;

class PartyPaymentController extends Controller
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
            $rows = PartyPayment::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new PartyPayment())->getTable());
        $allSuppliersColumns = Schema::getColumnListing((new Suppliers())->getTable());

        $payments = PartyPayment::with('supplier')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allSuppliersColumns) {
                $query->where(function ($query) use ($keyword, $allColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere(
                            $column,
                            'LIKE',
                            "%$keyword%"
                        );
                    }
                });

                // searching from suppliers
                $query->orWhereHas('supplier', function ($query) use ($keyword, $allSuppliersColumns) {
                    $query->where(function ($query) use ($keyword, $allSuppliersColumns) {
                        foreach ($allSuppliersColumns as $column) {
                            $query->orWhere($column, 'LIKE', "%$keyword%");
                        }
                    });
                });
            })
            ->latest()
            ->paginate($rows);

        // $payments = PartyPayment::all();
        $party = Suppliers::whereStatus(true)->get();
        return view('admin.party-payment.payment', compact('party', 'payments'));
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
            'type' => 'required',
            'supplier_id' => 'required',
            'amt' => 'required',
            'date' => 'required',
            'mode' => 'required'
        ]);

        PartyPayment::create($request->post());

        return redirect()->route('payment.index')->with('success', 'Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartyPayment  $partyPayment
     * @return \Illuminate\Http\Response
     */
    public function show(PartyPayment $partyPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartyPayment  $partyPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(PartyPayment $partyPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PartyPayment  $partyPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartyPayment $partyPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartyPayment  $partyPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartyPayment $partyPayment)
    {
        //
    }
}
