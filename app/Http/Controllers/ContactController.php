<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'correo_empresa' => ['nullable', 'email'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'mensaje' => ['required', 'string'],
            'servicio' => ['nullable', 'string', 'max:100'],
            'turnstile_token' => ['nullable', 'string'],
        ]);

        Lead::create([
            'nombre' => $request->nombre,
            'email' => $request->email ?? $request->correo_empresa,
            'telefono' => $request->telefono,
            'servicio' => $request->servicio ?? ($request->correo_empresa ? 'corporativo' : null),
            'mensaje' => $request->mensaje ?? $request->mensaje_corporativo,
            'origen' => $request->correo_empresa ? 'corporativo' : 'contacto',
        ]);

        return redirect()->back()->with('success', 'Mensaje enviado. Te contactaremos pronto.');
    }
}
