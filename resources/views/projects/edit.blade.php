<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('projects.show', $project->id) }}" class="mr-4 p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Project</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $project->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('projects.update', $project->id) }}" id="project-form">
                        @csrf
                        @method('PUT')

                        <!-- Lead Selection -->
                        <div class="mb-4">
                            <x-input-label for="lead_id" :value="__('Select Customer (Lead)')" />
                            <select name="lead_id" id="lead_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach($leads as $lead)
                                    <option value="{{ $lead->id }}" {{ $project->lead_id == $lead->id ? 'selected' : '' }}>
                                        {{ $lead->name }} - {{ $lead->company ?? 'Individual' }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lead_id')" class="mt-2" />
                        </div>

                        <!-- Project Name -->
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Project Name / Deal Title')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $project->name)" required placeholder="e.g. Instalasi Internet Restoran Padang" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <hr class="mb-6 border-gray-200">

                        <h3 class="text-lg font-medium text-gray-900 mb-4">Product Items</h3>

                        <!-- Items Container -->
                        <div id="items-container" class="space-y-4 mb-6">
                            @foreach($project->items as $index => $item)
                            <div class="item-row border p-4 rounded-lg bg-gray-50 relative">
                                @if($index > 0)
                                <button type="button" onclick="this.parentElement.remove(); calculateTotal()" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold">&times;</button>
                                @endif
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                    <div class="col-span-4">
                                        <label class="block text-sm font-medium text-gray-700">Product</label>
                                        <select name="items[{{ $index }}][product_id]" class="product-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" onchange="updatePrice(this)">
                                            <option value="">-- Select Product --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }} (Std: Rp {{ number_format($product->price,0,',','.') }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Qty</label>
                                        <input type="number" name="items[{{ $index }}][quantity]" class="qty-input block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $item->quantity }}" min="1" oninput="calculateTotal()">
                                    </div>
                                    <div class="col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">Deal Price (Per Unit)</label>
                                        <input type="number" name="items[{{ $index }}][negotiated_price]" class="price-input block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $item->negotiated_price }}" placeholder="Negosiasi" oninput="calculateTotal()">
                                    </div>
                                    <div class="col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">Subtotal</label>
                                        <div class="py-2 text-gray-900 font-bold item-subtotal">Rp {{ number_format($item->negotiated_price * $item->quantity, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" onclick="addItem()" class="mb-6 text-sm text-indigo-600 hover:text-indigo-900 font-bold">+ Add Another Product</button>

                        <div class="bg-indigo-50 p-4 rounded-lg flex justify-between items-center mb-6">
                            <span class="text-lg font-bold text-gray-800">Total Project Value:</span>
                            <span id="grand-total" class="text-2xl font-bold text-indigo-700">Rp {{ number_format($project->total_amount, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Project') }}</x-primary-button>
                            <a href="{{ route('projects.show', $project->id) }}" class="text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Dynamic Items -->
    <script>
        let itemIndex = {{ $project->items->count() }};
        const productsParams = @json($products);

        function addItem() {
            const container = document.getElementById('items-container');
            const newRow = document.createElement('div');
            newRow.classList.add('item-row', 'border', 'p-4', 'rounded-lg', 'bg-gray-50', 'relative');

            let options = '<option value="">-- Select Product --</option>';
            productsParams.forEach(p => {
                options += `<option value="${p.id}" data-price="${p.price}">${p.name} (Std: Rp ${new Intl.NumberFormat('id-ID').format(p.price)})</option>`;
            });

            newRow.innerHTML = `
                <button type="button" onclick="this.parentElement.remove(); calculateTotal()" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold">&times;</button>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <div class="col-span-4">
                        <label class="block text-sm font-medium text-gray-700">Product</label>
                        <select name="items[${itemIndex}][product_id]" class="product-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" onchange="updatePrice(this)">
                            ${options}
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Qty</label>
                        <input type="number" name="items[${itemIndex}][quantity]" class="qty-input block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="1" min="1" oninput="calculateTotal()">
                    </div>
                    <div class="col-span-3">
                        <label class="block text-sm font-medium text-gray-700">Deal Price (Per Unit)</label>
                        <input type="number" name="items[${itemIndex}][negotiated_price]" class="price-input block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Negosiasi" oninput="calculateTotal()">
                    </div>
                    <div class="col-span-3">
                        <label class="block text-sm font-medium text-gray-700">Subtotal</label>
                        <div class="py-2 text-gray-900 font-bold item-subtotal">Rp 0</div>
                    </div>
                </div>
            `;
            container.appendChild(newRow);
            itemIndex++;
        }

        function updatePrice(select) {
            const price = select.options[select.selectedIndex].getAttribute('data-price');
            const row = select.closest('.item-row');
            const priceInput = row.querySelector('.price-input');
            if(price) {
                if(!priceInput.value) priceInput.value = parseInt(price);
            }
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            const rows = document.querySelectorAll('.item-row');

            rows.forEach(row => {
                const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
                const price = parseFloat(row.querySelector('.price-input').value) || 0;
                const subtotal = qty * price;

                row.querySelector('.item-subtotal').textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(subtotal);

                total += subtotal;
            });

            document.getElementById('grand-total').textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(total);
        }

        // Calculate total on page load
        document.addEventListener('DOMContentLoaded', function() {
            calculateTotal();
        });
    </script>
</x-app-layout>
