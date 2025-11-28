<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->filled('q')) {
            $query->where('nombre', 'like', '%'.$request->q.'%')
                ->orWhere('email', 'like', '%'.$request->q.'%');
        }

        $leads = $query->orderByDesc('created_at')->paginate(20)->withQueryString();

        return view('admin.leads.index', compact('leads'));
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->back()->with('success', 'Lead eliminado.');
    }
}
