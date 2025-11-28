<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        $order->load('items');

        return view('user.orders.show', compact('order'));
    }
}
