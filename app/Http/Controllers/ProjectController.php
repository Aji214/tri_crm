<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Lead;
use App\Models\Product;
use App\Models\ProjectItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::forUser(auth()->user())->with(['lead', 'user'])->latest()->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Sales can only see their own leads, Manager sees all
        $leads = Lead::forUser(auth()->user())->get();
        $products = Product::all();
        return view('projects.create', compact('leads', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'name' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.negotiated_price' => 'required|numeric|min:0',
        ]);

        // Verify lead ownership for Sales
        $lead = Lead::find($request->lead_id);
        if (auth()->user()->isSales() && $lead->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this lead.');
        }

        DB::transaction(function () use ($request) {
            $status = 'completed'; // Default status if data is clean
            $totalAmount = 0;

            // 1. Calculate Approvals & Totals
            foreach ($request->items as $itemData) {
                $product = Product::find($itemData['product_id']);
                $totalAmount += $itemData['negotiated_price'] * $itemData['quantity'];

                // Rule: If negotiated price < selling price, need approval
                if ($itemData['negotiated_price'] < $product->price) {
                    $status = 'waiting_approval';
                }
            }

            // 2. Create Project
            $project = Project::create([
                'user_id' => auth()->id(),
                'lead_id' => $request->lead_id,
                'name' => $request->name,
                'total_amount' => $totalAmount,
                'status' => $status,
            ]);

            // Auto update Lead status to 'Won' if project is completed directly
            if ($status === 'completed') {
                $lead = Lead::find($request->lead_id);
                if ($lead) {
                    $lead->update(['status' => 'Won']);
                }
            }

            // 3. Create Items
            foreach ($request->items as $itemData) {
                 $product = Product::find($itemData['product_id']);
                 ProjectItem::create([
                    'project_id' => $project->id,
                    'product_id' => $itemData['product_id'],
                    'quantity' => $itemData['quantity'],
                    'base_price' => $product->price,
                    'negotiated_price' => $itemData['negotiated_price'],
                 ]);
            }
        });

        return redirect()->route('projects.index')->with('success', 'Project deal created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorizeAccess($project);
        $project->load(['lead', 'items.product', 'user']);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorizeAccess($project);
        $project->load(['lead', 'items.product']);
        $leads = Lead::forUser(auth()->user())->get();
        $products = Product::all();
        return view('projects.edit', compact('project', 'leads', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorizeAccess($project);

        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'name' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.negotiated_price' => 'required|numeric|min:0',
        ]);

        // Verify lead ownership for Sales
        $lead = Lead::find($request->lead_id);
        if (auth()->user()->isSales() && $lead->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this lead.');
        }

        DB::transaction(function () use ($request, $project) {
            $status = 'completed';
            $totalAmount = 0;

            // Calculate Approvals & Totals
            foreach ($request->items as $itemData) {
                $product = Product::find($itemData['product_id']);
                $totalAmount += $itemData['negotiated_price'] * $itemData['quantity'];

                if ($itemData['negotiated_price'] < $product->price) {
                    $status = 'waiting_approval';
                }
            }

            // Update Project
            $project->update([
                'lead_id' => $request->lead_id,
                'name' => $request->name,
                'total_amount' => $totalAmount,
                'status' => $status,
            ]);

            // Delete old items and create new ones
            $project->items()->delete();

            foreach ($request->items as $itemData) {
                $product = Product::find($itemData['product_id']);
                ProjectItem::create([
                    'project_id' => $project->id,
                    'product_id' => $itemData['product_id'],
                    'quantity' => $itemData['quantity'],
                    'base_price' => $product->price,
                    'negotiated_price' => $itemData['negotiated_price'],
                ]);
            }
        });

        return redirect()->route('projects.show', $project->id)->with('success', 'Project updated successfully.');
    }

    public function approve(Project $project)
    {
        $this->authorizeManagerOnly();
        $project->update(['status' => 'approved']);

        // Auto update Lead status to 'Won' when project is approved
        if ($project->lead) {
            $project->lead->update(['status' => 'Won']);
        }

        return back()->with('success', 'Project approved. Lead status updated to Won.');
    }

    public function reject(Project $project)
    {
        $this->authorizeManagerOnly();
        $project->update(['status' => 'rejected']);
        return back()->with('success', 'Project rejected.');
    }

    /**
     * Convert lead to customer by marking project as completed
     */
    public function convertToCustomer(Project $project)
    {
        $this->authorizeAccess($project);

        // Only approved projects can be converted to completed
        if (!in_array($project->status, ['approved', 'waiting_approval', 'completed'])) {
            return back()->with('error', 'Cannot convert rejected project.');
        }

        $project->update(['status' => 'completed']);

        // Update Lead status to 'Won'
        if ($project->lead) {
            $project->lead->update(['status' => 'Won']);
        }

        return back()->with('success', 'Project completed. Lead has been converted to Customer.');
    }

    /**
     * Check if current user can access this project
     */
    private function authorizeAccess(Project $project)
    {
        $user = auth()->user();
        if ($user->isSales() && $project->user_id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }
    }

    /**
     * Only Manager can approve/reject
     */
    private function authorizeManagerOnly()
    {
        if (!auth()->user()->isManager()) {
            abort(403, 'Only Manager can perform this action.');
        }
    }
}
