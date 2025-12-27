<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Data for Charts/Display - filtered by user role
        $projects = Project::forUser($user)
            ->with('lead')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->latest()
            ->get();

        $totalRevenue = $projects->whereIn('status', ['approved', 'completed'])->sum('total_amount');
        $totalDeals = $projects->count();
        $successfulDeals = $projects->whereIn('status', ['approved', 'completed'])->count();

        // Lead Conversion Stats - filtered by user role
        $newLeadsCount = Lead::forUser($user)
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->count();

        // Top 5 Products - filtered by user role
        $topProductsQuery = \Illuminate\Support\Facades\DB::table('project_items')
            ->join('products', 'project_items.product_id', '=', 'products.id')
            ->join('projects', 'project_items.project_id', '=', 'projects.id')
            ->select('products.name', \Illuminate\Support\Facades\DB::raw('SUM(project_items.quantity) as total_qty'))
            ->whereBetween('projects.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        // Filter by user if Sales
        if ($user->isSales()) {
            $topProductsQuery->where('projects.user_id', $user->id);
        }

        $topProducts = $topProductsQuery
            ->groupBy('products.name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        return view('reports.index', compact(
            'startDate',
            'endDate',
            'totalRevenue',
            'totalDeals',
            'successfulDeals',
            'newLeadsCount',
            'topProducts',
            'projects'
        ));
    }

    public function export(Request $request)
    {
        $user = auth()->user();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(
            new SalesReportExport($startDate . ' 00:00:00', $endDate . ' 23:59:59', $user),
            'sales_report_'.$startDate.'_to_'.$endDate.'.xlsx'
        );
    }
}
