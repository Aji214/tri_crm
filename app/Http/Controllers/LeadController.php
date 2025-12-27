<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::forUser(auth()->user())->with('user')->latest()->get();
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'requirements' => 'required',
            'status' => 'required',
        ]);

        Lead::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'contact' => $request->contact,
            'address' => $request->address,
            'requirements' => $request->requirements,
            'status' => $request->status,
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        $this->authorizeAccess($lead);
        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        $this->authorizeAccess($lead);
        return view('leads.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $this->authorizeAccess($lead);

        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'requirements' => 'required',
            'status' => 'required',
        ]);

        $lead->update($request->only(['name', 'contact', 'address', 'requirements', 'status']));

        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $this->authorizeAccess($lead);
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }

    /**
     * Check if current user can access this lead
     */
    private function authorizeAccess(Lead $lead)
    {
        $user = auth()->user();
        if ($user->isSales() && $lead->user_id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }
    }
}
