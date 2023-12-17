<div class="p-4 bg-white dark:bg-transparent flex justify-between" id="torrent-bottom-bar-container">
    <button class="inline-flex items-center space-x-2 mr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
        <i class="fas fa-smile fa-lg text-green-200"></i>
        <span>
            <div>
                {{ number_format($torrent->likes) }}
            </div>
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
        <span>{{ number_format($torrent->signatures->count()) }}</span>
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