<div class="space-y-4">
    <div class="max-w-2xl mt-1 items-center justify-center m-auto" id="handle-setter-container">
        <div class="px-4 mt-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200 mb-4">
                handle
            </h2>
            @if(empty($user->handle))
                <div class="bg-blue-50 dark:bg-blue-50 p-6 rounded-lg shadow-md text-gray-800 mb-4">
                    <h2 class="text-2xl font-bold mb-2">welcome to voxtorrent</h2>
                    <p>
                        A handle is your identity on the platform. It is a unique identifier that is used to identify you and your content. It is also used to create your profile URL. You can change your handle at any time.
                    </p>
                    <p class="mt-4">
                        Your handle can be your real name, a nickname, or a pseudonym. It can be anything you want it to be, as long as it is not already taken by another user and doesn't violate our terms of service.
                    </p>
                </div>
            @endif
            @if(!empty($user->handle))
                <div class="bg-yellow-50 dark:bg-yellow-50 p-6 rounded-lg shadow-md text-gray-800 mb-4">
                    <h2 class="text-2xl font-bold mb-2">your handle</h2>
                    <p>
                        Your handle is <span class="font-bold">{{ $user->handle }}</span>. You can change it at any time, but be aware that changing your handle will change your profile URL.
                    </p>
                </div>
            @endif
            <div class="" id="handle-setter-form">
                <form wire:submit.prevent="setHandle" class="space-y-4">
                    <div class="flex flex-col">
                        <label for="handle" class="text-gray-900 dark:text-gray-100">set your handle</label>
                        <input type="text" wire:model="handle" placeholder="{{ $user->handle }}" id="handle" class="w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @error('handle') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <button type="submit" class="w-full bg-orange-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            set handle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>