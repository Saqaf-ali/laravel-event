<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\Web\OrderItemResource;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

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
        $this->orderService->create($request->validated());

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
