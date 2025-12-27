<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Active Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">List of Active Customers</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($customers as $customer)
                            <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition duration-200 overflow-hidden">
                                <div class="bg-indigo-50 px-4 py-3 border-b flex justify-between items-center">
                                    <h4 class="font-bold text-gray-900 truncate" title="{{ $customer->name }}">
                                        {{ $customer->name }}
                                    </h4>
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">Active</span>
                                </div>
                                <div class="p-4">
                                    <div class="text-sm text-gray-600 mb-4">
                                        <p><span class="font-semibold">Contact:</span> {{ $customer->contact }}</p>
                                        <p class="truncate" title="{{ $customer->address }}"><span class="font-semibold">Address:</span> {{ $customer->address }}</p>
                                    </div>
                                    
                                    <hr class="border-gray-100 mb-3">
                                    
                                    <h5 class="text-xs font-bold text-gray-500 uppercase mb-2">Subscribed Services:</h5>
                                    <ul class="space-y-2">
                                        @foreach($customer->projects as $project)
                                            @foreach($project->items as $item)
                                                <li class="flex items-start text-sm">
                                                    <svg class="h-4 w-4 text-green-500 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <div>
                                                        <span class="font-medium text-gray-900">{{ $item->product->name }}</span>
                                                        <span class="text-gray-500 text-xs block">
                                                            Qty: {{ $item->quantity }} &bull; Project: {{ $project->name }}
                                                        </span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 border-t text-right">
                                    <a href="{{ route('leads.edit', $customer->id) }}" class="text-xs text-indigo-600 hover:text-indigo-900 font-medium">View Customer Profile &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-10 bg-gray-50 rounded-lg border-2 border-dashed">
                                <p class="text-gray-500 font-medium">No active customers found.</p>
                                <p class="text-sm text-gray-400 mt-1">Customers will appear here once their projects are approved/completed.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
