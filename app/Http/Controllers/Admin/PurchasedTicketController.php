<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchasedTicket;
use App\Http\Requests\StorePurchasedTicketRequest;
use App\Http\Requests\UpdatePurchasedTicketRequest;

class PurchasedTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchasedTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchasedTicket $purchasedTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchasedTicket $purchasedTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchasedTicketRequest $request, PurchasedTicket $purchasedTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchasedTicket $purchasedTicket)
    {
        //
    }
}
