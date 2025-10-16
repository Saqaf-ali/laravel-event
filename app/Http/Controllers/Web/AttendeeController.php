<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\OrderItemResource;
use App\Http\Resources\Web\OrderResource;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    // show all orders of an attendee
    public function index()
    {
        $orders = Auth::user()->attendee->orders()->latest('updated_at')->paginate(8);
        return Inertia('Web/Attendees/Index', ['orders' => OrderResource::collection($orders)]);
    }
    public function show(Order $order)
    {
          dd($order);
        $orderItems = $order->orderItems()->latest('updated_at')->paginate(8);

        return Inertia('Web/Attendees/Show', ['orderItems' => OrderItemResource::collection($orderItems)]);
    }
}
