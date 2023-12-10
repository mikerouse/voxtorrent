<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <a href="/create" class="inline-flex items-center mx-2 justify-center py-2 px-4 border border-transparent text-base font-medium rounded-md text-white bg-orange-400 hover:bg-red-600">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>
                <!-- Add more buttons here -->
                <a href="/another-link" class="inline-flex items-center mx-2 justify-center p-2 border border-transparent text-base font-medium rounded-md text-white bg-gray-300 hover:bg-gray-300">
                    <i class="fas fa-plus-circle mr-2"></i> Another Button
                </a>
                <a href="/yet-another-link" class="inline-flex items-center mx-2 justify-center p-2 border border-transparent text-base font-medium rounded-md text-white bg-gray-300 hover:bg-gray-500">
                    <i class="fas fa-plus-circle mr-2"></i> Yet Another Button
                </a>
            </div>
        </div>

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    
                @can('do anything')
                    <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __("All Torrents") }}
                    </h2>
                    @livewire('all-torrents-list')
                @endcan
                
                <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __("Your Torrents") }}
                </h2>
                @livewire('torrent-list')

                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
