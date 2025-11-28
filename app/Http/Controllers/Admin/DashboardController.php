<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Lead;
use App\Models\Candidate;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'orders_new' => Order::where('estado', 'nuevo')->count(),
            'revenue_month' => Order::whereMonth('created_at', now()->month)->sum('total'),
            'products_active' => Product::where('estado', 1)->count(),
            'customers' => User::count(),
            'leads' => Lead::count(),
            'candidates' => Candidate::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
