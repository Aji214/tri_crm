<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Project Deals</h2>
                <p class="text-sm text-gray-500 mt-1">Manage your project pipeline</p>
            </div>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Create Deal
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($message = Session::get('success'))
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6 flex items-center" role="alert">
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-emerald-800">Success</p>
                        <p class="text-sm text-emerald-600">{{ $message }}</p>
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-5 gap-4 mb-6">
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Deals</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $projects->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-amber-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Waiting</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $projects->where('status', 'waiting_approval')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Approved</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $projects->where('status', 'approved')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Completed</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $projects->where('status', 'completed')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Value</p>
                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($projects->whereIn('status', ['approved', 'completed'])->sum('total_amount'), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900">Project Pipeline</h3>
                        <p class="text-xs text-gray-500 mt-0.5">All deals in your pipeline</p>
                    </div>
                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                        {{ $projects->count() }} projects
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-fixed">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th scope="col" class="w-[22%] px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Project</th>
                                <th scope="col" class="w-[18%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="w-[15%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Value</th>
                                <th scope="col" class="w-[12%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                @if(auth()->user()->isManager())
                                <th scope="col" class="w-[12%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Sales</th>
                                @endif
                                <th scope="col" class="w-[10%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                <th scope="col" class="w-[11%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($projects as $project)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3 min-w-0">
                                            <a href="{{ route('projects.show', $project->id) }}" class="text-sm font-semibold text-gray-900 hover:text-indigo-600 truncate block">{{ $project->name }}</a>
                                            <p class="text-xs text-gray-500">ID: #{{ str_pad($project->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm text-gray-700">{{ $project->lead->name ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm font-bold text-indigo-600">Rp {{ number_format($project->total_amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @php
                                        $statusColors = [
                                            'waiting_approval' => 'bg-amber-100 text-amber-700',
                                            'approved' => 'bg-emerald-100 text-emerald-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                            'completed' => 'bg-blue-100 text-blue-700',
                                        ];
                                        $statusColor = $statusColors[$project->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </td>
                                @if(auth()->user()->isManager())
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm text-gray-600">{{ $project->user->name ?? '-' }}</span>
                                </td>
                                @endif
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm text-gray-600">{{ $project->created_at->format('d M Y') }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('projects.show', $project->id) }}" class="inline-flex items-center justify-center w-8 h-8 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        @if(auth()->user()->isManager() && $project->status === 'waiting_approval')
                                        <form action="{{ route('projects.approve', $project->id) }}" method="POST" class="inline-flex">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 text-emerald-600 hover:bg-emerald-100 rounded-lg transition-colors" title="Approve">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('projects.reject', $project->id) }}" method="POST" class="inline-flex">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:bg-red-100 rounded-lg transition-colors" title="Reject" onclick="return confirm('Are you sure you want to reject this project?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                        @if($project->status === 'approved')
                                        <form action="{{ route('projects.convert', $project->id) }}" method="POST" class="inline-flex">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 bg-gray-800 hover:bg-gray-900 text-white rounded-lg transition-colors shadow-sm" title="Convert to Customer" onclick="return confirm('Mark this project as completed and convert lead to customer?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ auth()->user()->isManager() ? 7 : 6 }}" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">No projects found</p>
                                        <p class="text-sm text-gray-400 mt-1">Get started by creating your first deal</p>
                                        <a href="{{ route('projects.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Create Deal
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($projects->count() > 0)
                <!-- Footer Summary -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Pipeline Summary</p>
                                <p class="text-xs text-gray-500">{{ $projects->count() }} total projects</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6">
                            <div class="text-center px-3">
                                <p class="text-lg font-bold text-amber-600">{{ $projects->where('status', 'waiting_approval')->count() }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Waiting</p>
                            </div>
                            <div class="text-center px-3">
                                <p class="text-lg font-bold text-emerald-600">{{ $projects->where('status', 'approved')->count() }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Approved</p>
                            </div>
                            <div class="text-center px-3">
                                <p class="text-lg font-bold text-blue-600">{{ $projects->where('status', 'completed')->count() }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Completed</p>
                            </div>
                            <div class="text-center px-3">
                                <p class="text-lg font-bold text-red-600">{{ $projects->where('status', 'rejected')->count() }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Rejected</p>
                            </div>
                            <div class="text-center px-4 py-2 bg-indigo-50 rounded-lg">
                                <p class="text-lg font-bold text-indigo-600">Rp {{ number_format($projects->whereIn('status', ['approved', 'completed'])->sum('total_amount'), 0, ',', '.') }}</p>
                                <p class="text-xs text-indigo-600 uppercase tracking-wider mt-1">Total Value</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
