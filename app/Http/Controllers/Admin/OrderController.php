<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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
