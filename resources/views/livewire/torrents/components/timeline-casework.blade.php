<div class="border dark:border-yellow-200 rounded-md mb-4">
    <livewire:torrents.components.owner :torrent="$torrent" :key="$torrent->id" />
    <livewire:torrents.components.decisionmakersdisplay :torrent="$torrent" :key="$torrent->id" />
    <livewire:torrents.components.torrentcontent :torrent="$torrent" :key="$torrent->id" />
    <livewire:torrents.components.hashtags-display :torrent="$torrent" :key="$torrent->id" />
    <livewire:torrents.components.footer :torrent="$torrent" :key="$torrent->id" />
    <livewire:torrents.components.party-line :torrent="$torrent" :key="$torrent->id" />
</div>