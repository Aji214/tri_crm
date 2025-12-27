<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Reports</h2>
                <p class="text-sm text-gray-500 mt-1">Sales performance and analytics</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
                <form method="GET" action="{{ route('reports.index') }}" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate }}"
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate }}"
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
                        Apply Filter
                    </button>
                </form>
            </div>

            <!-- Summary Cards -->
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
                        <p class="text-xs text-gray-500 mt-1">Total revenue in period</p>
                    </div>
                </div>

                <!-- Total Deals -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded">Deals</span>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $totalDeals }}</p>
                        <p class="text-xs text-gray-500 mt-1">Total deals created</p>
                    </div>
                </div>

                <!-- Successful Deals -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 bg-amber-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded">Success</span>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $successfulDeals }}</p>
                        <p class="text-xs text-gray-500 mt-1">Approved deals</p>
                    </div>
                </div>

                <!-- New Leads -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 bg-violet-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-violet-600 bg-violet-50 px-2 py-1 rounded">Leads</span>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $newLeadsCount }}</p>
                        <p class="text-xs text-gray-500 mt-1">New leads acquired</p>
                    </div>
                </div>
            </div>

            <!-- Analytics Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Top Products -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-900">Top 5 Products</h3>
                            <p class="text-xs text-gray-500 mt-0.5">By quantity sold</p>
                        </div>
                        <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="p-5">
                        @if($topProducts->count() > 0)
                            <div class="space-y-3">
                                @foreach($topProducts as $index => $product)
                                    @php
                                        $maxQty = $topProducts->first()->total_qty;
                                        $percentage = $maxQty > 0 ? ($product->total_qty / $maxQty) * 100 : 0;
                                        $colors = [
                                            0 => ['bg' => 'bg-amber-500', 'text' => 'text-white', 'bar' => 'bg-amber-500', 'light' => 'bg-amber-50'],
                                            1 => ['bg' => 'bg-gray-400', 'text' => 'text-white', 'bar' => 'bg-gray-400', 'light' => 'bg-gray-50'],
                                            2 => ['bg' => 'bg-orange-400', 'text' => 'text-white', 'bar' => 'bg-orange-400', 'light' => 'bg-orange-50'],
                                            3 => ['bg' => 'bg-indigo-400', 'text' => 'text-white', 'bar' => 'bg-indigo-400', 'light' => 'bg-indigo-50'],
                                            4 => ['bg' => 'bg-emerald-400', 'text' => 'text-white', 'bar' => 'bg-emerald-400', 'light' => 'bg-emerald-50'],
                                        ];
                                        $color = $colors[$index] ?? $colors[4];
                                    @endphp
                                    <div class="flex items-center p-3 rounded-xl {{ $color['light'] }} hover:shadow-sm transition-all">
                                        <div class="flex-shrink-0 w-8 h-8 {{ $color['bg'] }} rounded-lg flex items-center justify-center {{ $color['text'] }} text-sm font-bold shadow-sm">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <div class="flex justify-between items-center mb-1.5">
                                                <span class="text-sm font-semibold text-gray-900 truncate">{{ $product->name }}</span>
                                                <span class="text-sm font-bold text-gray-700 ml-2 flex-shrink-0">{{ number_format($product->total_qty, 0, ',', '.') }} <span class="text-xs font-normal text-gray-500">units</span></span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="{{ $color['bar'] }} h-2 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500">No product data available</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Deal Performance -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-900">Deal Performance</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Conversion rate analysis</p>
                        </div>
                        <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="p-5">
                        @php
                            $conversionRate = $totalDeals > 0 ? ($successfulDeals / $totalDeals) * 100 : 0;
                            // Determine color based on conversion rate
                            if ($conversionRate >= 70) {
                                $rateColor = 'emerald';
                                $rateLabel = 'Excellent';
                            } elseif ($conversionRate >= 50) {
                                $rateColor = 'blue';
                                $rateLabel = 'Good';
                            } elseif ($conversionRate >= 30) {
                                $rateColor = 'amber';
                                $rateLabel = 'Average';
                            } else {
                                $rateColor = 'red';
                                $rateLabel = 'Needs Improvement';
                            }
                        @endphp

                        <!-- Conversion Rate Gauge -->
                        <div class="mb-6 p-4 bg-{{ $rateColor }}-50 rounded-xl">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-700">Conversion Rate</span>
                                    <span class="ml-2 px-2 py-0.5 text-xs font-semibold bg-{{ $rateColor }}-100 text-{{ $rateColor }}-700 rounded-full">{{ $rateLabel }}</span>
                                </div>
                                <span class="text-2xl font-bold text-{{ $rateColor }}-600">{{ number_format($conversionRate, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-{{ $rateColor }}-500 h-3 rounded-full transition-all duration-500 relative" style="width: {{ $conversionRate }}%">
                                    @if($conversionRate > 10)
                                    <div class="absolute right-1 top-1/2 -translate-y-1/2 w-1.5 h-1.5 bg-white rounded-full"></div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-between mt-2 text-xs text-gray-500">
                                <span>0%</span>
                                <span>50%</span>
                                <span>100%</span>
                            </div>
                        </div>

                        <!-- Stats Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-emerald-50 rounded-xl text-center border border-emerald-100">
                                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-emerald-600">{{ $successfulDeals }}</p>
                                <p class="text-xs text-emerald-700 mt-1">Approved</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl text-center border border-gray-100">
                                <div class="w-10 h-10 bg-gray-400 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-600">{{ $totalDeals - $successfulDeals }}</p>
                                <p class="text-xs text-gray-600 mt-1">Pending/Rejected</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Report Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900">Project Deals Report</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Detailed list of all deals in selected period</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                            {{ $projects->count() }} records
                        </span>
                        <a href="{{ route('reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded-lg transition-all shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download Excel
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="w-[12%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                <th scope="col" class="w-[28%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Project Name</th>
                                <th scope="col" class="w-[24%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="w-[16%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th scope="col" class="w-[20%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($projects as $project)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 text-center text-sm text-gray-600">
                                    {{ $project->created_at->format('d M Y') }}
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <a href="{{ route('projects.show', $project->id) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                        {{ $project->name }}
                                    </a>
                                </td>
                                <td class="px-4 py-4 text-center text-sm text-gray-900">
                                    {{ $project->lead->name ?? '-' }}
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full
                                        {{ $project->status === 'approved' ? 'bg-emerald-100 text-emerald-700' :
                                           ($project->status === 'completed' ? 'bg-blue-100 text-blue-700' :
                                           ($project->status === 'rejected' ? 'bg-red-100 text-red-700' :
                                           ($project->status === 'waiting_approval' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700'))) }}">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center text-sm font-semibold text-gray-900">
                                    Rp {{ number_format($project->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm">No projects found for this period</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($projects->count() > 0)
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-sm font-bold text-gray-900 text-right">Total</td>
                                <td class="px-4 py-4 text-sm font-bold text-indigo-600 text-center">
                                    Rp {{ number_format($projects->sum('total_amount'), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
