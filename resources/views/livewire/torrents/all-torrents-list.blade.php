<div class="space-y-4">
    @foreach($torrents as $torrent)
        <div class="border rounded">
            <div id="torrent-owner-name-and-photo-container" class="flex items-center space-x-2 p-4 bg-white">
                <img class="w-15 h-15 rounded-full" src="{{ sprintf('https://ui-avatars.com/api/?name=%s', urlencode($torrent->owner->name)) }}" alt="{{ $torrent->owner->name }}'s photo">
                <span>
                    <div class="font-bold">
                        {{ $torrent->owner->name }} 
                        <span>
                            <i class="fas fa-check-circle text-blue-400"></i>
                        </span>
                    </div>
                    <div class="font-light text-sm">
                        {{ $torrent->owner->location }}London || 2hrs ago || 1.2k views
                    </div>
                </span>
            </div>
            <div class="text-gray-600 dark:text-gray-400 text-lg bg-white pt-0 pr-4 pl-4 pb-0">
                {{ $torrent->description }}
            </div>
            <div class="p-4 bg-white dark:bg-transparent flex justify-between" id="torrent-bottom-bar-container">
                <button class="inline-flex items-center space-x-2 mr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="fas fa-smile fa-lg text-green-200"></i>
                    <span>
                        <div>
                            {{ number_format($torrent->likes) }}
                        </div>
                        {{-- <div class="text-xs">
                            <i class="fas fa-circle text-blue-200"></i> 20%
                        </div>
                        <div class="text-xs">
                            <i class="fas fa-circle text-red-200"></i> 20%
                        </div>
                        <div class="text-xs">
                            <i class="fas fa-circle text-orange-200"></i> 20%
                        </div>
                        <div class="text-xs">
                            <i class="fas fa-circle text-purple-200"></i> 20%
                        </div>
                        <div class="text-xs">
                            <i class="fas fa-circle text-green-200"></i> 20%
                        </div> --}}
                    </span>
                </button>
                <button class="inline-flex items-center space-x-2 mr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="fas fa-meh fa-lg text-gray-200"></i>
                    <span>{{ number_format($torrent->neutralFaces) }}</span>
                </button>
                <button class="inline-flex items-center space-x-2 mr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="fas fa-frown fa-lg text-red-200"></i>
                    <span>{{ number_format($torrent->dislikes) }}</span>
                </button>
                <span class="inline-flex items-center space-x-2 mr-3 text-gray-500 dark:text-gray-400">
                    <i class="fas fa-certificate fa-lg text-blue-200"></i>
                    <span>{{ number_format($torrent->signatures_count) }}</span>
                </span>
                <span class="inline-flex items-center space-x-2 mr-3 text-gray-500 dark:text-gray-400">
                    <i class="fas fa-bookmark fa-lg text-gray-200"></i>
                    <span>1234</span>
                </span>
                <span class="inline-flex items-center space-x-2 mr-3 text-gray-500 dark:text-gray-400">
                    <i class="fa-solid fa-arrow-up-from-bracket text-gray-200"></i>
                    <span>1234</span>
                </span>   
            </div>
            {{-- <div class="flex w-full h-4" id="likes-by-party-percentages-bar">
                <div class="bg-blue-500" style="width: {{ $torrent->conservativeLikesPercentage }}%"></div>
                <div class="bg-red-500" style="width: {{ $torrent->labourLikesPercentage }}%"></div>
                <div class="bg-yellow-500" style="width: {{ $torrent->libDemLikesPercentage }}%"></div>
                <div class="bg-purple-500" style="width: {{ $torrent->ukipLikesPercentage }}%"></div>
                <div class="bg-green-500" style="width: {{ $torrent->greenLikesPercentage }}%"></div>
            </div> --}}
            <div class="flex w-full h-4" id="likes-by-party-percentages-bar">
                <div class="bg-blue-500" style="width: 60%"></div>
                <div class="bg-red-500" style="width: 10%"></div>
                <div class="bg-yellow-500" style="width: 10%"></div>
                <div class="bg-purple-500" style="width: 10%"></div>
                <div class="bg-green-500" style="width: 10%"></div>
            </div>
        </div>
    @endforeach
</div>