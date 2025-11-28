<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function create()
    {
        return view('user.support');
    }

    public function store(Request $request)
    {
        $request->validate([
            'asunto' => ['required', 'string', 'max:255'],
            'mensaje' => ['required', 'string'],
        ]);

        Lead::create([
            'nombre' => auth()->user()->name ?? 'Usuario',
            'email' => auth()->user()->email ?? null,
            'telefono' => null,
            'servicio' => 'soporte',
            'mensaje' => $request->mensaje,
            'origen' => 'soporte-usuario',
        ]);

        return redirect()->back()->with('success', 'Hemos recibido tu mensaje de soporte. Te contactaremos pronto.');
    }
}
