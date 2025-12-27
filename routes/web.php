<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    // Leads Data - filtered by user role
    $totalLeads = \App\Models\Lead::forUser($user)->count();
    $newLeads = \App\Models\Lead::forUser($user)->where('status', 'New')->count();
    $recentLeads = \App\Models\Lead::forUser($user)->with('user')->latest()->take(5)->get();

    // Products Data - shared for all users
    $totalProducts = \App\Models\Product::count();
    $recentProducts = \App\Models\Product::latest()->take(5)->get();

    // Projects Data - filtered by user role
    $totalProjects = \App\Models\Project::forUser($user)->count();
    $pendingProjects = \App\Models\Project::forUser($user)->where('status', 'waiting_approval')->count();
    $approvedProjects = \App\Models\Project::forUser($user)->where('status', 'approved')->count();
    $recentProjects = \App\Models\Project::forUser($user)->with(['lead', 'user'])->latest()->take(5)->get();

    // Active Customers (from approved projects) - filtered by user role
    $activeCustomers = \App\Models\Project::forUser($user)
        ->whereIn('status', ['approved', 'completed'])
        ->distinct('lead_id')->count('lead_id');

    // Revenue - filtered by user role
    $totalRevenue = \App\Models\Project::forUser($user)
        ->whereIn('status', ['approved', 'completed'])->sum('total_amount');
    $monthlyRevenue = \App\Models\Project::forUser($user)
        ->whereIn('status', ['approved', 'completed'])
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('total_amount');

    return view('dashboard', compact(
        'totalLeads', 'newLeads', 'recentLeads',
        'totalProducts', 'recentProducts',
        'totalProjects', 'pendingProjects', 'approvedProjects', 'recentProjects',
        'activeCustomers', 'totalRevenue', 'monthlyRevenue'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
    Route::resource('leads', LeadController::class);
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::post('/projects/{project}/approve', [App\Http\Controllers\ProjectController::class, 'approve'])->name('projects.approve');
    Route::post('/projects/{project}/reject', [App\Http\Controllers\ProjectController::class, 'reject'])->name('projects.reject');
    Route::post('/projects/{project}/convert', [App\Http\Controllers\ProjectController::class, 'convertToCustomer'])->name('projects.convert');
    Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [App\Http\Controllers\ReportController::class, 'export'])->name('reports.export');
});

require __DIR__.'/auth.php';
