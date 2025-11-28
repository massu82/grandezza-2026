<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('codigo', 'like', '%'.$request->q.'%')
                    ->orWhere('nombre_cliente', 'like', '%'.$request->q.'%');
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->string('estado'));
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->date('fecha_desde'));
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->date('fecha_hasta'));
        }

        $orders = $query->orderByDesc('created_at')->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return redirect('/admin/orders/'.$order->id);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->update([
            'estado' => $request->estado ?? $order->estado,
            'notas_internas' => $request->notas_internas ?? $order->notas_internas,
        ]);

        return redirect()->back()->with('success', 'Pedido actualizado.');
    }

    public function destroy(Order $order)
    {
        return redirect()->back();
    }
}
