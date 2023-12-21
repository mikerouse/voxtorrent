<div class="space-y-4">

    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto" id="torrent-list-container">

        <div class="w-full mx-auto sm:px-6 lg:px-8 justify-center" id="#torrent-list-container">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __("latest") }}
                    </h2>
                    @foreach($torrents as $torrent)
                        @if($torrent->type == 'casework')
                            <livewire:torrents.components.timeline-casework :torrent="$torrent" :key="$torrent->id" />
                        @elseif($torrent->type == 'petition')
                            <livewire:torrents.components.timeline-single :torrent="$torrent" :key="$torrent->id" />
                        @else
                            <livewire:torrents.components.timeline-single :torrent="$torrent" :key="$torrent->id" />
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full py-6 flex justify-center">
            {{ $torrents->links() }}
        </div>

    </div>

</div>