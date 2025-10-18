<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Http\Resources\Web\PurchasedTicketResource;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItems = OrderItem::with('order.attendee.user', 'ticket.event')->latest('updated_at')->get();
        dd($orderItems);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        $purchasedTickets = $orderItem->purchasedTickets()->with('orderItem.ticket')->latest('updated_at')->paginate(8);
        return Inertia('Web/order_items/Show', ['purchasedTickets' => PurchasedTicketResource::collection($purchasedTickets)]);
    }
}
