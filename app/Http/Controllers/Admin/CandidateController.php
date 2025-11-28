<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        $query = Candidate::query();

        if ($request->filled('q')) {
            $query->where('nombre', 'like', '%'.$request->q.'%')
                ->orWhere('email', 'like', '%'.$request->q.'%');
        }

        $candidates = $query->orderByDesc('created_at')->paginate(20)->withQueryString();

        return view('admin.candidates.index', compact('candidates'));
    }

    public function show(Candidate $candidate)
    {
        return view('admin.candidates.show', compact('candidate'));
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->back()->with('success', 'Candidato eliminado.');
    }
}
