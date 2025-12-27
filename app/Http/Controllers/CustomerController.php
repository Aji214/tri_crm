<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $user = auth()->user();

        // Get Leads that have at least one project with status 'approved' or 'completed'
        // Filter by user ownership for Sales
        $customers = Lead::forUser($user)
            ->whereHas('projects', function ($query) use ($user) {
                $query->whereIn('status', ['approved', 'completed']);
                if ($user->isSales()) {
                    $query->where('user_id', $user->id);
                }
            })
            ->with(['projects' => function ($query) use ($user) {
                $query->whereIn('status', ['approved', 'completed'])
                      ->with('items.product');
                if ($user->isSales()) {
                    $query->where('user_id', $user->id);
                }
            }, 'user'])
            ->get();

        return view('customers.index', compact('customers'));
    }
}
