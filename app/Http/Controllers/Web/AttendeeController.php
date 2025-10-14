<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\AttendeeResource;
use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    // show all orders of an attendee
    public function index()
    {
        $orders = Auth::user()->attendee->orders()->latest('updated_at')->paginate(8);
        return Inertia('Web/Attendees/Index', ['orders' => AttendeeResource::collection($orders)]);
    }
}
