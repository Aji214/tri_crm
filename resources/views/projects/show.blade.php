<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('projects.index') }}" class="mr-4 p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Project Details</h2>
                    <p class="text-sm text-gray-500 mt-1">View complete project information</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('projects.edit', $project->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Project
                </a>
            </div>
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

            <!-- Authorization Actions -->
            @if($project->status === 'waiting_approval')
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-5 mb-6">
                <div class="flex items-start justify-between">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-amber-800 text-lg">Approval Required</p>
                            <p class="text-sm text-amber-700 mt-1">This project contains items sold below the standard price and requires manager approval.</p>
                        </div>
                    </div>
                    @if(auth()->user()->isManager())
                    <div class="flex gap-2 flex-shrink-0 ml-4">
                        <form action="{{ route('projects.approve', $project->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow-sm transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Approve
                            </button>
                        </form>
                        <form action="{{ route('projects.reject', $project->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reject
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="flex items-center bg-amber-100 px-4 py-2 rounded-lg flex-shrink-0 ml-4">
                        <svg class="w-4 h-4 text-amber-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-amber-700">Waiting for Manager approval</span>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

                <!-- Left Column - Project Info -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Project Header Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-900">{{ $project->name }}</h3>
                                            <p class="text-sm text-gray-500">Project ID: #{{ str_pad($project->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $statusConfig = [
                                        'waiting_approval' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'approved' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'completed' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                                    ];
                                    $config = $statusConfig[$project->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                                @endphp
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                                    </svg>
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </div>

                            <!-- Project Details Grid -->
                            <div class="grid grid-cols-2 gap-6 mt-6 pt-6 border-t border-gray-100">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider font-medium">Created Date</p>
                                        <p class="text-base font-bold text-gray-900 mt-1">{{ $project->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider font-medium">Last Updated</p>
                                        <p class="text-base font-bold text-gray-900 mt-1">{{ $project->updated_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider font-medium">Created By</p>
                                        <p class="text-base font-bold text-gray-900 mt-1">{{ $project->user->name ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider font-medium">Total Items</p>
                                        <p class="text-base font-bold text-gray-900 mt-1">{{ $project->items->count() }} Products</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Items Table -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <div>
                                <h4 class="font-semibold text-gray-900">Project Items</h4>
                                <p class="text-xs text-gray-500 mt-0.5">Products included in this project deal</p>
                            </div>
                            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                {{ $project->items->count() }} items
                            </span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Product</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Base Price</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Deal Price</th>
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Discount</th>
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Qty</th>
                                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($project->items as $item)
                                    @php
                                        $discountPercent = $item->base_price > 0 ? (($item->base_price - $item->negotiated_price) / $item->base_price) * 100 : 0;
                                        $isDiscounted = $item->negotiated_price < $item->base_price;
                                    @endphp
                                    <tr class="hover:bg-gray-50/50 transition-colors {{ $isDiscounted ? 'bg-red-50/50' : '' }}">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-900">{{ $item->product->name }}</p>
                                                    @if($isDiscounted)
                                                        <span class="inline-flex items-center text-xs text-red-600 mt-1">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                            </svg>
                                                            Below standard price
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-right">
                                            <span class="text-sm text-gray-500">Rp {{ number_format($item->base_price, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-4 py-4 text-right">
                                            <span class="text-sm font-bold {{ $isDiscounted ? 'text-red-600' : 'text-gray-900' }}">
                                                Rp {{ number_format($item->negotiated_price, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @if($discountPercent > 0)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                    -{{ number_format($discountPercent, 1) }}%
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-sm font-semibold text-gray-700">
                                                {{ $item->quantity }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($item->negotiated_price * $item->quantity, 0, ',', '.') }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Table Footer - Totals -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-t border-gray-200">
                            @php
                                $totalBasePrice = $project->items->sum(function($item) { return $item->base_price * $item->quantity; });
                                $totalNegotiatedPrice = $project->items->sum(function($item) { return $item->negotiated_price * $item->quantity; });
                                $totalDiscount = $totalBasePrice - $totalNegotiatedPrice;
                                $totalDiscountPercent = $totalBasePrice > 0 ? ($totalDiscount / $totalBasePrice) * 100 : 0;
                            @endphp
                            <div class="space-y-2">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-500">Subtotal (Base Price)</span>
                                    <span class="text-gray-700">Rp {{ number_format($totalBasePrice, 0, ',', '.') }}</span>
                                </div>
                                @if($totalDiscount > 0)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-red-600">Total Discount ({{ number_format($totalDiscountPercent, 1) }}%)</span>
                                    <span class="text-red-600 font-medium">- Rp {{ number_format($totalDiscount, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                    <span class="text-lg font-bold text-gray-900">Grand Total</span>
                                    <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($project->total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Customer & Summary -->
                <div class="space-y-6">

                    <!-- Customer Info Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h4 class="font-semibold text-gray-900">Customer Information</h4>
                            <a href="{{ route('leads.show', $project->lead->id) }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">View Profile</a>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center shadow-lg">
                                    <span class="text-white text-xl font-bold">{{ strtoupper(substr($project->lead->name, 0, 1)) }}</span>
                                </div>
                                <div class="ml-4">
                                    <p class="text-lg font-bold text-gray-900">{{ $project->lead->name }}</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                        Customer
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-5 pt-4 border-t border-gray-100">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider font-medium">Contact</p>
                                        <p class="text-sm font-semibold text-gray-900 mt-1">{{ $project->lead->contact }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider font-medium">Address</p>
                                        <p class="text-sm font-semibold text-gray-900 mt-1">{{ $project->lead->address }}</p>
                                    </div>
                                </div>
                                @if($project->lead->requirements)
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider font-medium">Requirements</p>
                                        <p class="text-sm font-semibold text-gray-900 mt-1">{{ $project->lead->requirements }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Project Summary Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h4 class="font-bold text-lg text-gray-900">Project Summary</h4>
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 px-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <span class="text-gray-700 font-medium">Total Items</span>
                                    <span class="text-xl font-bold text-gray-900">{{ $project->items->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 px-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <span class="text-gray-700 font-medium">Total Quantity</span>
                                    <span class="text-xl font-bold text-gray-900">{{ $project->items->sum('quantity') }} <span class="text-sm font-normal text-gray-500">units</span></span>
                                </div>
                                @if($totalDiscount > 0)
                                <div class="flex justify-between items-center py-3 px-4 bg-red-50 rounded-lg border border-red-200">
                                    <span class="text-red-700 font-medium">Total Discount</span>
                                    <span class="text-xl font-bold text-red-600">-{{ number_format($totalDiscountPercent, 1) }}%</span>
                                </div>
                                @endif
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center py-4 px-4 bg-indigo-50 rounded-xl border border-indigo-200">
                                        <span class="text-indigo-700 font-semibold text-lg">Total Value</span>
                                        <span class="text-2xl font-black text-indigo-600">Rp {{ number_format($project->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100">
                            <h4 class="font-semibold text-gray-900">Quick Actions</h4>
                        </div>
                        <div class="p-4">
                            <div class="flex gap-3">
                                <a href="{{ route('projects.edit', $project->id) }}" class="flex-1 flex flex-col items-center p-4 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 transition-colors group">
                                    <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mb-3 group-hover:bg-gray-900 transition-colors shadow-sm">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 text-center">Edit Project</p>
                                </a>
                                <a href="{{ route('leads.show', $project->lead->id) }}" class="flex-1 flex flex-col items-center p-4 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 transition-colors group">
                                    <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mb-3 group-hover:bg-gray-900 transition-colors shadow-sm">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 text-center">View Customer</p>
                                </a>
                                <a href="{{ route('projects.index') }}" class="flex-1 flex flex-col items-center p-4 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 transition-colors group">
                                    <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mb-3 group-hover:bg-gray-900 transition-colors shadow-sm">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 text-center">All Projects</p>
                                </a>
                            </div>
                            @if($project->status === 'approved')
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <form action="{{ route('projects.convert', $project->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-colors shadow-sm" onclick="return confirm('Mark this project as completed and convert lead to customer?')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Convert to Customer
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
