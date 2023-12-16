<div class="space-y-4">
    <div class="max-w-2xl mt-1 items-center justify-center m-auto" id="spring-container">
        <!-- Cover photo -->
        <div class="w-full h-64 overflow-hidden bg-gradient-to-r from-red-500 via-yellow-500 to-blue-500">
            @if(!empty($user->cover_photo_url))
                <img src="{{ $user->cover_photo_url }}" alt="Cover photo" class="w-full h-full object-cover">
            @endif
        </div>

        <!-- Profile photo and name -->
        <div class="relative -mt-16 px-4">
            <div class="flex items-end justify-between">
                <div class="flex items-center space-x-4">
                    <!-- Profile photo -->
                    <img src="{{ !empty($user->profile_photo_url) ? $user->profile_photo_url : '' }}" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}'"
                        alt="Profile photo" class="w-24 h-24 rounded-full border-4 border-white">
                    <!-- Name -->
                    <div class="text-gray-900 dark:text-gray-100">
                        <h1 class="text-2xl font-bold">{{ $user->handle }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- List of torrents -->
        <div class="px-4 mt-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200 mb-4">
                {{ $user->handle }}'s torrents
            </h2>
            <ul class="space-y-2">
                @foreach($user->owned_torrents as $torrent)
                    <livewire:torrents.components.timeline-single :torrent="$torrent" :key="$torrent->id" />
                @endforeach
            </ul>
        </div>
    </div>
</div>