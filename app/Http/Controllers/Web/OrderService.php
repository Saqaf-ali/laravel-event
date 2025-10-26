<?php

namespace App\Services;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\OrderStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Create a new order with its items and purchased tickets.
     *
     * @param StoreOrderRequest $request
     * @return Order
     * @throws \Throwable
     */
    public function create(StoreOrderRequest $request): Order
    {
        return DB::transaction(function () use ($request) {
            $order = Order::create([
                'attendee_id' => Auth::user()->attendee->id,
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

                $purchasedTickets = [];
                for ($i = 0; $i < $orderItem->quantity; $i++) {
                    $purchasedTickets[] = [
                        'ticket_code' => 'TICKET-' . uniqid() . '_' . ($i + 1),
                        'is_used' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $orderItem->purchasedTickets()->insert($purchasedTickets);
            }

            return $order;
        });
    }
}
