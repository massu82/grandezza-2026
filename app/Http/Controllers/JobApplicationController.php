<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'puesto' => ['required', 'string', 'max:255'],
            'cv' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            'mensaje' => ['nullable', 'string'],
            'turnstile_token' => ['nullable', 'string'],
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        Candidate::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'puesto' => $request->puesto,
            'cv_path' => $cvPath,
            'mensaje' => $request->mensaje,
        ]);

        return redirect()->back()->with('success', 'Hemos recibido tu aplicación. Te contactaremos pronto.');
    }
}
