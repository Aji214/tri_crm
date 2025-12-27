<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lead') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('leads.update', $lead->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $lead->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Contact -->
                        <div class="mb-4">
                            <x-input-label for="contact" :value="__('Contact Info (Phone/Email)')" />
                            <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact" :value="old('contact', $lead->contact)" required />
                            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('address', $lead->address) }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Requirements -->
                        <div class="mb-4">
                            <x-input-label for="requirements" :value="__('Requirements / Needs')" />
                            <textarea id="requirements" name="requirements" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('requirements', $lead->requirements) }}</textarea>
                            <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled>Select Status</option>
                                <option value="New" {{ old('status', $lead->status) == 'New' ? 'selected' : '' }}>New</option>
                                <option value="Contacted" {{ old('status', $lead->status) == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="Qualified" {{ old('status', $lead->status) == 'Qualified' ? 'selected' : '' }}>Qualified</option>
                                <option value="Negotiation" {{ old('status', $lead->status) == 'Negotiation' ? 'selected' : '' }}>Negotiation</option>
                                <option value="Won" {{ old('status', $lead->status) == 'Won' ? 'selected' : '' }}>Won</option>
                                <option value="Lost" {{ old('status', $lead->status) == 'Lost' ? 'selected' : '' }}>Lost</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('leads.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>
                            <x-primary-button>
                                {{ __('Update Lead') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
