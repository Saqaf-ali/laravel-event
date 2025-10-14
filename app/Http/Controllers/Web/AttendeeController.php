<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    // show all orders of an attendee
    public function index()
    {
        $orders = Auth::user()->attendee->orders()->get();
        return Inertia('Web/Attendees/Index', ['orders' => $orders]);
    }
}
