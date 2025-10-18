<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;


class PurchasedTicketController extends Controller
{
    public function index()
    {
        
        return inertia('Web/PurchasedTickets/Index');
    }

}
