<div class="space-y-4">
    @foreach($torrents as $torrent)
        <div class="p-4 border rounded bg-white dark:bg-gray-800">
            <h3 class="text-xl">
                <a href="#" class="font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-300 dark:hover:text-blue-500">{{ $torrent->name }}</a>
            </h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $torrent->description }}</p>
            <div class="mt-4 space-x-2">
                <button class="inline-flex items-center space-x-1 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="fas fa-smile fa-lg text-green-500"></i>
                    <span>{{ number_format($torrent->likes) }}</span>
                </button>
                <button class="inline-flex items-center space-x-1 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="fas fa-meh fa-lg text-yellow-500"></i>
                    <span>{{ number_format($torrent->neutralFaces) }}</span>
                </button>
                <button class="inline-flex items-center space-x-1 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="fas fa-frown fa-lg text-orange-500"></i>
                    <span>{{ number_format($torrent->dislikes) }}</span>
                </button>
                <span class="inline-flex items-center space-x-1 text-gray-500 dark:text-gray-400">
                    <i class="fas fa-pen-fancy fa-lg text-blue-500"></i>
                    <span>{{ number_format($torrent->signatures_count) }}</span>
                </span>
            </div>
        </div>
    @endforeach
</div>