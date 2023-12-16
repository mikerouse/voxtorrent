<div id="hashtags-display-container" class="text-gray-500 dark:text-gray-300 py-2 px-4">
    @foreach($torrent->hashtags as $hashtag)
        <span class="hashtag-display-on-torrent">#{{ $hashtag->name }}</span>
    @endforeach
</div> 