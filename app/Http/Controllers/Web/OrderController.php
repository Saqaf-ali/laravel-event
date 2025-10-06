<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Auth;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

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
        // get user

        dd();
        foreach ($request->items as $key => $item) {
            $order = Order::create([
                'attendee_id' => Auth::user()->attendee->id,
                'event_id' => $item['event_id'],
                'total_price' => $item['total_price'],
                'status' => 'pending',
            ]);
            $order->save();
            foreach ($item['tickets'] as $ticket) {
                $order->orderItems()->create([
                    'ticket_id' => $ticket['ticket_id'],
                    'quantity' => $ticket['quantity'],
                    'price' => $ticket['price'],
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        session()->flash('success', 'Order deleted successfully.');
        return redirect()->route('orders.index');
    }
    /**
     * Display a listing of the trashed resources.
     */
    public function trashed()
    {
        $orders = Order::onlyTrashed()->with('attendee.user', 'event')->latest('updated_at')->get();
        return Inertia('Admin/orders/Trashed', ['orders' => $orders]);
    }

    /**
     * Restore the specified resource.
     */
    public function restore(Order $order)
    {
        $order->restore();
        session()->flash('success', 'Order restored successfully.');
        return redirect()->route('orders.trashed');
    }

    /**
     * Delete the specified resource.
     */
    public function delete(Order $order)
    {
        $order->forceDelete();
        session()->flash('success', 'Order deleted permanently.');
        return redirect()->route('orders.trashed');
    }
}
