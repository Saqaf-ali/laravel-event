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
        $purchasedTicket = $purchasedTicket->load('orderItem.ticket.event');
        return inertia('Web/purchased_tickets/Show', ['purchasedTicket' => new PurchasedTicketResource($purchasedTicket)]);
    }
}
