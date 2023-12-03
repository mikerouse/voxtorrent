<div class="text-gray-900 dark:text-white">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    <div>
        <form wire:submit.prevent="updateRoles">
            <div class="flex flex-wrap -mx-2" style="column-count: 3;">
                @foreach($allRoles as $role)
                    <div class="w-full sm:w-1/2 md:w-1/3 px-2" style="break-inside: avoid;">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model="userRoles" value="{{ $role->id }}" class="form-checkbox h-5 w-5 text-gray-600">
                            <span class="ml-2">{{ $role->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('userRoles')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ $message }}</span>
            </div>
            @enderror
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">{{ __('Save Roles') }}</button>
            <div x-data="{ show: false }" x-show.transition.opacity.out.duration.1500ms="show" x-init="@this.on('roles-updated', () => { show = true; setTimeout(() => { show = false; }, 2000); })" class="mt-3 text-green-500">
                {{ __('Roles updated.') }}
            </div>
        </form>
    </div>
</div>