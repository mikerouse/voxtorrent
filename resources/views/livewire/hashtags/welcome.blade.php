<div class="space-y-4">
    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto" id="torrent-list-container">
        <div class="w-full mx-auto sm:px-6 lg:px-8 justify-center" id="#torrent-list-container">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __("hashtags") }}
                    </h2>
                </div>
                <div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                        <ul class="grid grid-cols-2 gap-4">
                            @foreach ($hashtags as $hashtag)
                                <li class="flex items-center">
                                    <span class="text-gray-600 dark:text-gray-400">#{{ $hashtag->name }}</span>
                                    <span class="dark:text-gray-400 ml-2 text-xs text-gray-400"><i class="fas fa-wave-square mr-1"></i>{{ $hashtag->torrents->count() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>