<?php

namespace App\Http\Controllers;

use App\Models\PartyPayment;
use App\Models\Suppliers;
use Illuminate\Http\Request;

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
        $payments = PartyPayment::all();
        $party = Suppliers::whereStatus(true)->get();
        return view('admin.party-payment.payment',compact('party','payments'));
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
            'mode' => 'required',
        ]);

        PartyPayment::create($request->post());

        return redirect()->route('payment.index')->with('success','Data Added Successfully');
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
