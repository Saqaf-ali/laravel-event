<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\OrderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\Web\OrderItemResource;
use App\OrderStatus;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Auth::user()->attendee->orders()->latest('updated_at')->paginate(8);
        return Inertia('Web/orders/Index', ['orders' => OrderResource::collection($orders)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        // get attendeeId
        // $attendeeId = Auth::user()->attendee['id'];
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
        // Clear the cart after successful order
        $request->session()->forget('cart');

        session()->flash('success', 'Order created successfully.');
        return redirect()->route('web.orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $orderItems = $order->orderItems()->with('ticket')->latest('updated_at')->paginate(8);

        return Inertia('Web/order_items/Index', ['orderItems' => OrderItemResource::collection($orderItems)]);
    }
}
