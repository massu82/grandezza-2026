<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $ordersCount = Order::where('user_id', auth()->id())->count();
        $lastOrder = Order::where('user_id', auth()->id())->latest()->first();

        return view('user.dashboard', compact('ordersCount', 'lastOrder'));
    }
}
