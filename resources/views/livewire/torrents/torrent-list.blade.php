<div class="space-y-4">
    @foreach($torrents as $torrent)
        <div class="p-4 border rounded shadow">
            <a href="#" class="text-lg font-semibold text-blue-600 hover:text-blue-800">{{ $torrent->name }}</a>
            <p class="mt-2 text-gray-600">{{ $torrent->description }}</p>
            <div class="mt-4 space-x-2">
                <button class="inline-flex items-center space-x-1 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-thumbs-up"></i>
                    <span>{{ number_format($torrent->likes) }}</span>
                </button>
                <button class="inline-flex items-center space-x-1 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-thumbs-down"></i>
                    <span>{{ number_format($torrent->dislikes) }}</span>
                </button>
                <span class="inline-flex items-center space-x-1 text-gray-500">
                    <i class="fas fa-pen-fancy"></i>
                    <span>{{ number_format($torrent->signatures_count) }}</span>
                </span>
            </div>
        </div>
    @endforeach
</div>