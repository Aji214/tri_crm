<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
                <p class="text-sm text-gray-500 mt-1">Welcome back, {{ Auth::user()->name }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="px-3 py-1.5 text-xs font-semibold rounded-full {{ Auth::user()->isManager() ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
                <span class="text-sm text-gray-500 hidden sm:block">{{ now()->format('l, d M Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total Revenue -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 bg-emerald-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded">Revenue</span>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 mt-1">From approved deals</p>
                    </div>
                </div>

                <!-- Monthly Revenue -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded">Monthly</span>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ now()->format('F Y') }}</p>
                    </div>
                </div>

                <!-- Total Deals -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 bg-violet-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-violet-600 bg-violet-50 px-2 py-1 rounded">Deals</span>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $totalProjects }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-xs text-amber-600">{{ $pendingProjects }} pending</span>
                            <span class="text-gray-300">|</span>
                            <span class="text-xs text-emerald-600">{{ $approvedProjects }} approved</span>
                        </div>
                    </div>
                </div>

                <!-- Active Customers -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 bg-amber-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded">Customers</span>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $activeCustomers }}</p>
                        <p class="text-xs text-gray-500 mt-1">Active customers</p>
                    </div>
                </div>
            </div>

            <!-- Secondary Stats -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2 mb-6">
                <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-gray-100">
                    <a href="{{ route('leads.index') }}" class="px-4 py-3 hover:bg-blue-50 transition-colors rounded-lg">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600">{{ $totalLeads }}</p>
                            <p class="text-sm text-gray-600 mt-1">Total Leads</p>
                        </div>
                    </a>

                    <a href="{{ route('products.index') }}" class="px-4 py-3 hover:bg-orange-50 transition-colors rounded-lg">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-orange-600">{{ $totalProducts }}</p>
                            <p class="text-sm text-gray-600 mt-1">Products</p>
                        </div>
                    </a>

                    <a href="{{ route('projects.index') }}" class="px-4 py-3 hover:bg-amber-50 transition-colors rounded-lg">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-amber-600">{{ $pendingProjects }}</p>
                            <p class="text-sm text-gray-600 mt-1">Pending</p>
                        </div>
                    </a>

                    <a href="{{ route('leads.index') }}" class="px-4 py-3 hover:bg-emerald-50 transition-colors rounded-lg">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-emerald-600">{{ $newLeads }}</p>
                            <p class="text-sm text-gray-600 mt-1">New Leads</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Recent Leads -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900">Recent Leads</h3>
                        <a href="{{ route('leads.index') }}" class="inline-flex items-center px-3 py-1.5 bg-gray-800 hover:bg-gray-900 text-white text-xs font-medium rounded-lg transition-colors">View All</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($recentLeads as $lead)
                            <div class="px-5 py-3 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium text-sm">
                                        {{ strtoupper(substr($lead->name, 0, 1)) }}
                                    </div>
                                    <div class="ml-3 flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $lead->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ $lead->contact }}</p>
                                    </div>
                                    <span class="px-2 py-0.5 text-xs font-medium rounded
                                        {{ $lead->status == 'New' ? 'bg-emerald-100 text-emerald-700' :
                                           ($lead->status == 'Contacted' ? 'bg-blue-100 text-blue-700' :
                                           ($lead->status == 'Qualified' ? 'bg-violet-100 text-violet-700' : 'bg-gray-100 text-gray-700')) }}">
                                        {{ $lead->status }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="px-5 py-8 text-center">
                                <p class="text-sm text-gray-500">No leads yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Deals -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900">Recent Deals</h3>
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-3 py-1.5 bg-gray-800 hover:bg-gray-900 text-white text-xs font-medium rounded-lg transition-colors">View All</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($recentProjects as $project)
                            <div class="px-5 py-3 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $project->name }}</p>
                                    <span class="px-2 py-0.5 text-xs font-medium rounded
                                        {{ $project->status == 'approved' ? 'bg-emerald-100 text-emerald-700' :
                                           ($project->status == 'waiting_approval' ? 'bg-amber-100 text-amber-700' :
                                           ($project->status == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700')) }}">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-xs text-gray-500">{{ $project->lead->name ?? '-' }}</p>
                                    <p class="text-sm font-semibold text-gray-900">Rp {{ number_format($project->total_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="px-5 py-8 text-center">
                                <p class="text-sm text-gray-500">No deals yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="p-4">
                        <div class="flex gap-3">
                            <a href="{{ route('leads.create') }}" class="flex-1 flex flex-col items-center p-4 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 transition-colors group">
                                <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mb-3 group-hover:bg-gray-900 transition-colors shadow-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 text-center">Add New Lead</p>
                            </a>

                            <a href="{{ route('projects.create') }}" class="flex-1 flex flex-col items-center p-4 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 transition-colors group">
                                <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mb-3 group-hover:bg-gray-900 transition-colors shadow-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 text-center">Create New Deal</p>
                            </a>

                            <a href="{{ route('products.create') }}" class="flex-1 flex flex-col items-center p-4 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 transition-colors group">
                                <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mb-3 group-hover:bg-gray-900 transition-colors shadow-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 text-center">Add Product</p>
                            </a>

                            <a href="{{ route('reports.index') }}" class="flex-1 flex flex-col items-center p-4 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 transition-colors group">
                                <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mb-3 group-hover:bg-gray-900 transition-colors shadow-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 text-center">View Reports</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900">Products Catalog</h3>
                        <p class="text-xs text-gray-500">{{ $recentProducts->count() }} products available</p>
                    </div>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg transition-colors">
                        View All
                    </a>
                </div>
                <div class="p-6">
                    @if($recentProducts->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                            @foreach($recentProducts as $product)
                                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all">
                                    <!-- Header -->
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-sm font-bold text-gray-900 leading-tight">{{ $product->name }}</h4>
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            +{{ number_format($product->margin, 0) }}%
                                        </span>
                                    </div>

                                    <!-- Price Info Table -->
                                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                                        <table class="w-full text-sm">
                                            <tbody>
                                                <tr class="border-b border-gray-100">
                                                    <td class="py-2.5 px-3 text-gray-500">Selling Price</td>
                                                    <td class="py-2.5 px-3 text-right font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr class="border-b border-gray-100">
                                                    <td class="py-2.5 px-3 text-gray-500">HPP</td>
                                                    <td class="py-2.5 px-3 text-right font-semibold text-gray-600">Rp {{ number_format($product->hpp, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr class="bg-emerald-50">
                                                    <td class="py-2.5 px-3 text-emerald-700 font-medium">Profit</td>
                                                    <td class="py-2.5 px-3 text-right font-bold text-emerald-600">Rp {{ number_format($product->price - $product->hpp, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">No products yet</p>
                            <p class="text-sm text-gray-400 mt-1">Add your first product to get started</p>
                            <a href="{{ route('products.create') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Product
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
