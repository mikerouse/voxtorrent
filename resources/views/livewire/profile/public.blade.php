<div class="text-gray-900 dark:text-white">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    <div>

        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('public profile') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('this information is visible to the public') }}
            </p>
        </header>

        <form wire:submit.prevent="updateRoles">
            <div class="mt-6">
                <div>
                    <x-input-label for="update_location" :value="__('current location')" />
                    <x-text-input wire:model="location" id="update_location" name="location" type="text" class="mt-1 block w-full" autocomplete="city" />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="update_bio" :value="__('bio')" />
                    <x-text-input wire:model="bio" id="update_bio" name="location" type="text" class="mt-1 block w-full" autocomplete="biography" />
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>
            </div>
            @error('publicProfile')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ $message }}</span>
            </div>
            @enderror
            <button type="submit" class="px-4 py-2 mt-6 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">{{ __('Save Public Profile') }}</button>
            <div x-data="{ show: false }" x-show.transition.opacity.out.duration.1500ms="show" x-init="@this.on('roles-updated', () => { show = true; setTimeout(() => { show = false; }, 2000); })" class="mt-3 text-green-500">
                {{ __('Roles updated.') }}
            </div>
        </form>
    </div>
</div>