<?php

namespace App\Http\Controllers;

use App\Models\PartyPayment;
use Illuminate\Http\Request;

class PartyPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.party-payment.payment');
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
        //
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
