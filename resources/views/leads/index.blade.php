<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Leads</h2>
                <p class="text-sm text-gray-500 mt-1">Manage your potential customers</p>
            </div>
            <a href="{{ route('leads.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Lead
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
            @php
                $statusCounts = $leads->groupBy('status')->map->count();
                $closingCount = $statusCounts->get('Closing', 0);
            @endphp
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Leads</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $leads->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Baru</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $statusCounts->get('Baru', 0) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-amber-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Contacted</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $statusCounts->get('Contacted', 0) }}</p>
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
                            <p class="text-sm font-medium text-gray-500">Closing</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $closingCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leads Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900">Lead List</h3>
                        <p class="text-xs text-gray-500 mt-0.5">All potential customers in your pipeline</p>
                    </div>
                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                        {{ $leads->count() }} leads
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-fixed">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th scope="col" class="w-[22%] px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lead Info</th>
                                <th scope="col" class="w-[15%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                                <th scope="col" class="w-[23%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Requirements</th>
                                <th scope="col" class="w-[12%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                @if(auth()->user()->isManager())
                                <th scope="col" class="w-[13%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Sales</th>
                                @endif
                                <th scope="col" class="w-[15%] px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($leads as $lead)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <span class="text-white text-sm font-bold">{{ strtoupper(substr($lead->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="ml-3 min-w-0">
                                            <a href="{{ route('leads.show', $lead->id) }}" class="text-sm font-semibold text-gray-900 hover:text-indigo-600 truncate block">{{ $lead->name }}</a>
                                            <p class="text-xs text-gray-500 truncate">{{ Str::limit($lead->address, 30) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm text-gray-700">{{ $lead->contact }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($lead->requirements, 60) }}</p>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @php
                                        $statusColors = [
                                            'New' => 'bg-blue-100 text-blue-700',
                                            'Contacted' => 'bg-amber-100 text-amber-700',
                                            'Qualified' => 'bg-emerald-100 text-emerald-700',
                                            'Proposal' => 'bg-purple-100 text-purple-700',
                                            'Negotiation' => 'bg-orange-100 text-orange-700',
                                            'Won' => 'bg-green-100 text-green-700',
                                            'Lost' => 'bg-red-100 text-red-700',
                                        ];
                                        $statusColor = $statusColors[$lead->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                        {{ $lead->status }}
                                    </span>
                                </td>
                                @if(auth()->user()->isManager())
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm text-gray-600">{{ $lead->user->name ?? '-' }}</span>
                                </td>
                                @endif
                                <td class="px-4 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('leads.show', $lead->id) }}" class="inline-flex items-center justify-center w-8 h-8 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('projects.create') }}?lead_id={{ $lead->id }}" class="inline-flex items-center justify-center w-8 h-8 bg-gray-800 hover:bg-gray-900 text-white rounded-lg transition-colors shadow-sm" title="Create Deal">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('leads.edit', $lead->id) }}" class="inline-flex items-center justify-center w-8 h-8 text-indigo-600 hover:bg-indigo-100 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:bg-red-100 rounded-lg transition-colors" title="Delete" onclick="return confirm('Are you sure you want to delete this lead?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ auth()->user()->isManager() ? 6 : 5 }}" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">No leads found</p>
                                        <p class="text-sm text-gray-400 mt-1">Get started by adding your first lead</p>
                                        <a href="{{ route('leads.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Add Lead
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($leads->count() > 0)
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
                                <p class="text-sm font-bold text-gray-900">Lead Summary</p>
                                <p class="text-xs text-gray-500">{{ $leads->count() }} total leads in pipeline</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6">
                            <div class="text-center px-3">
                                <p class="text-lg font-bold text-blue-600">{{ $leads->where('status', 'Baru')->count() }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Baru</p>
                            </div>
                            <div class="text-center px-3">
                                <p class="text-lg font-bold text-amber-600">{{ $leads->where('status', 'Contacted')->count() }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Contacted</p>
                            </div>
                            <div class="text-center px-3">
                                <p class="text-lg font-bold text-purple-600">{{ $leads->where('status', 'Follow Up')->count() }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Follow Up</p>
                            </div>
                            <div class="text-center px-3">
                                <p class="text-lg font-bold text-emerald-600">{{ $leads->where('status', 'Closing')->count() }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Closing</p>
                            </div>
                            <div class="text-center px-4 py-2 bg-indigo-50 rounded-lg">
                                <p class="text-lg font-bold text-indigo-600">
                                    {{ $leads->count() > 0 ? number_format(($leads->where('status', 'Closing')->count() / $leads->count()) * 100, 1) : 0 }}%
                                </p>
                                <p class="text-xs text-indigo-600 uppercase tracking-wider mt-1">Conversion</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
