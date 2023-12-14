<x-app-layout>

    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto" id="torrent-list-container">

        <div class="w-full mx-auto sm:px-6 lg:px-8 justify-center" id="#torrent-list-container">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    
                <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __("latest") }}
                </h2>
                @livewire('all-torrents-list')
                
                <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __("Your Torrents") }}
                </h2>
                @livewire('torrent-list')

                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
