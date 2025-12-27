<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Photo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your profile photo.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.photo.update') }}" class="mt-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center gap-6">
            <!-- Current Photo -->
            <div class="shrink-0">
                @if(Auth::user()->profile_photo)
                    <img class="h-20 w-20 object-cover rounded-full border-2 border-gray-200"
                         src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                         alt="{{ Auth::user()->name }}" />
                @else
                    <div class="h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center border-2 border-gray-200">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Upload Input -->
            <div class="flex-1">
                <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file"
                           name="profile_photo"
                           accept="image/*"
                           class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100
                                  cursor-pointer"/>
                </label>
                <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
            </div>
        </div>

        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Save Photo') }}</x-primary-button>

            @if (session('status') === 'profile-photo-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    @if(Auth::user()->profile_photo)
    <form method="post" action="{{ route('profile.photo.destroy') }}" class="mt-4">
        @csrf
        @method('delete')
        <button type="submit" class="text-sm text-red-600 hover:text-red-800 underline">
            {{ __('Remove Photo') }}
        </button>
    </form>
    @endif
</section>
