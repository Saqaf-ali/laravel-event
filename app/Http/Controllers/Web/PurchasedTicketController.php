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
        $purchasedTicket = $purchasedTicket->orderItem()->latest('updated_at')->paginate(8);
        dd($purchasedTicket);

        return inertia('Web/purchased_tickets/Show', ['purchasedTickets' => PurchasedTicketResource::collection($purchasedTicket)]);
    }
}

