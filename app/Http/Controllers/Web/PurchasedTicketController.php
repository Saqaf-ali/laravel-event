<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\PurchasedTicketResource;
use App\Models\PurchasedTicket;

class PurchasedTicketController extends Controller
{
    public function index()
    {
        return inertia('Web/PurchasedTickets/Index');
    }
    public function show(PurchasedTicket $purchasedTicket)
    {
        $purchasedTicket = $purchasedTicket->orderItem()->with('ticket.event')->first();
        return inertia('Web/PurchasedTickets/Show', ['purchasedTicket' => new PurchasedTicketResource($purchasedTicket)]);
    }
}
