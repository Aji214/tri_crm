<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('products.update', $product->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Product Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- HPP -->
                        <div class="mb-4">
                            <x-input-label for="hpp" :value="__('HPP (Harga Pokok Penjualan)')" />
                            <div class="flex mt-1">
                                <span class="inline-flex items-center px-4 rounded-l-md border border-r-0 border-gray-300 bg-gray-100 text-gray-700 text-sm font-medium">
                                    Rp
                                </span>
                                <input type="number" name="hpp" id="hpp" class="block w-full rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="0" required value="{{ old('hpp', $product->hpp) }}">
                            </div>
                            <x-input-error :messages="$errors->get('hpp')" class="mt-2" />
                        </div>

                        <!-- Margin -->
                        <div class="mb-4">
                            <x-input-label for="margin" :value="__('Margin Sales (%)')" />
                            <div class="flex mt-1">
                                <input type="number" step="0.01" name="margin" id="margin" class="block w-full rounded-none rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="0" required value="{{ old('margin', $product->margin) }}">
                                <span class="inline-flex items-center px-4 rounded-r-md border border-l-0 border-gray-300 bg-gray-100 text-gray-700 text-sm font-medium">
                                    %
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('margin')" class="mt-2" />
                        </div>

                        <!-- Preview Price -->
                        <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                            <span class="block text-sm font-medium text-gray-700">Estimated Selling Price:</span>
                            <span id="preview-price" class="block text-2xl font-bold text-indigo-600 mt-1">Rp 0</span>
                            <p class="text-xs text-gray-500 mt-1">* Calculated automatically (HPP + Margin)</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Product') }}</x-primary-button>
                            <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Auto Calculation -->
    <script>
        const hppInput = document.getElementById('hpp');
        const marginInput = document.getElementById('margin');
        const previewPrice = document.getElementById('preview-price');

        function calculatePrice() {
            const hpp = parseFloat(hppInput.value) || 0;
            const margin = parseFloat(marginInput.value) || 0;
            
            const price = hpp + (hpp * (margin / 100));
            
            // Format to IDR currency
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });

            previewPrice.textContent = formatter.format(price);
        }

        hppInput.addEventListener('input', calculatePrice);
        marginInput.addEventListener('input', calculatePrice);

        // Initial Update
        calculatePrice();
    </script>
</x-app-layout>
