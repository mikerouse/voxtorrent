<div id="torrent-owner-name-and-photo-container" class="flex items-center space-x-2 p-4 dark:bg-gray-800 bg-white">
    <img class="w-15 h-15 rounded-full" src="{{ sprintf('https://ui-avatars.com/api/?name=%s', urlencode($torrent->owner->name)) }}" alt="{{ $torrent->owner->name }}'s photo">
    <span>
        <div class="font-bold">
            <span class="dark:text-white">{{ $torrent->owner->name }}</span>
            <span>
                <i class="fas fa-check-circle text-blue-400"></i>
            </span>
        </div>
        <div class="font-light text-sm">
            <span class="text-xs mr-4 text-gray-500">
                <a href="/{{ $torrent->owner->handle }}">
                    {{ '@' . $torrent->owner->handle }}
                </a>
            </span>
            <span class="text-xs mr-4 text-gray-500">
                <a href="/t/{{ $torrent->id }}">
                   {{ $torrent->created_at->diffForHumans() }}
                </a>
            </span>
            <span class="text-xs text-gray-500">{{ formatNumber($torrent->views) }} views</span>
        </div>
    </span>
</div>