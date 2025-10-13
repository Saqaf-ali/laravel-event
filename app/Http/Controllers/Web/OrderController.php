<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\OrderStatus;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('attendee.user', 'event')->latest('updated_at')->get();
        return Inertia('Admin/orders/Index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia('Admin/orders/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        // get attendeeId
        $attendeeId = Auth::user()->attendee['id'];

        // dd($request);

        $order = Order::create([
            'attendee_id' => Auth::user()->attendee['id'],
            'total_price' => $request->total_price,
            'status' => OrderStatus::Completed,
        ]);

        foreach ($request->items as $item) {
            $orderItem = $order->orderItems()->create([
                'ticket_id' => $item['id'],
                'event_id' => $item['event_id'],
                'quantity' => $item['quantity'],
                'line_total' => $item['price'] * $item['quantity'],
            ]);
            for ($i = 0; $i < $orderItem->quantity; $i++) {
                $orderItem->purchasedTickets()->create([
                    'ticket_code' => 'TICKET-' . uniqid() . '_' . ($i + 1),
                    'is_used' => false,
                ]);
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // AttributesAuth
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return Inertia('Admin/orders/Edit', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

  

}
