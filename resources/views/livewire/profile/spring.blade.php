<div class="space-y-4">
    <div class="max-w-2xl mt-1 items-center justify-center m-auto" id="spring-container">
        @if($owner)
            <div class="w-full text-center dark:bg-blue-50 p-5 text-sm">
                <div>
                    viewing your own profile
                </div>
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">Something went wrong.</span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div>
                    @if($editing)
                        <button wire:click="savechanges" class="text-blue-500 hover:text-blue-700">
                            save changes
                        </button>
                    @else
                        <button wire:click="editmode" class="text-blue-500 hover:text-blue-700">
                            edit profile
                        </button>
                    @endif
                </div>
            </div>
        @endif
        @can('do anything')
            @if(!$owner)
                <div class="w-full text-center dark:bg-yellow-100 p-5 text-sm">
                    <div>
                        you have super powers
                    </div>
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Something went wrong.</span>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div>
                        @if($editing)
                            <button wire:click="savechanges" class="text-blue-500 hover:text-blue-700">
                                save changes
                            </button>
                        @else
                            <button wire:click="editmode" class="text-blue-500 hover:text-blue-700">
                                edit this profile
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        @endcan
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
                    <div class="text-gray-900 dark:text-gray-100 mt-8">
                        <h1 class="text-2xl font-bold">
                            <span>
                                {{ $user->handle }}
                            </span>
                            <span> 
                                <i class="fas fa-check-circle text-sm text-blue-400"></i>
                            </span>
                        </h1>
                        <div class="">
                            <span class="mr-4">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $user->location }}</span>
                            </span>
                            <span>
                                <i class="fas fa-certificate"></i>
                                <span>
                                    @if($user->is_verified)
                                        {{ 'id verified' }}
                                    @else
                                        {{ 'id not verified' }}
                                    @endif  
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <script>
                document.addEventListener('livewire:init', () => {
                   Livewire.on('bio-updated', (event) => {
                        console.log(event);
                        alert(event.message);
                   });
                });
            </script>
        </div>
        @if($editing)
            <div class="px-4 mt-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200 mb-4">
                    {{ $user->handle }}'s bio
                </h2>
                <form wire:submit="updatebio">
                    <div class="text-gray-900 dark:text-gray-200 mb-4">
                        <textarea wire:model="bio" class="w-full h-24 p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-400 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
                            {{ $user->bio }}
                        </textarea>
                    </div>
                    <div class="text-gray-900 dark:text-gray-200 mb-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            update bio
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="px-4 mt-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200 mb-4">
                    {{ $user->handle }}'s bio
                </h2>
                <div class="text-gray-900 dark:text-gray-200 mb-4">
                    @if(empty($user->bio))
                        {{ $user->handle }} has not written a bio yet.
                    @else 
                        {{ $user->bio }}
                    @endif
                </div>
            </div>
        @endif

        @if($editing)
            <div class="p-4 mt-6 bg-yellow-200 text-yellow-900">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-900 mb-4">
                     your political party affiliation
                </h2>
                <div>
                    <p>
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>
                            this information is currently public
                        </span>
                    </p>
                </div>
                <form wire:submit="updateparty">
                    <div class="text-gray-900 dark:text-gray-200 mb-4">
                        <select wire:model="primary_political_party_id" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" name="primary_political_party_id">
                            <option value="">Select a political party</option>
                            @foreach($this->political_parties as $political_party)
                                <option value="{{ $political_party->id }}" class="dark:text-black">{{ $political_party->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-gray-900 dark:text-gray-200 mb-4">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            update party
                        </button>
                    </div>
                </form>
            </div>
        @else 
            <div class="px-4 mt-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200 mb-4">
                    {{ $user->handle }}'s party affiliation
                </h2>
                <div class="text-gray-900 dark:text-gray-200 mb-4">
                    @if(empty($user->primary_political_party))
                        {{ $user->handle }} has not selected a political party yet.
                    @else 
                        {{ $user->primary_political_party->name }}
                    @endif
                </div>
            </div>
        @endif

        <!-- List of torrents -->
        <div class="px-4 mt-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200 mb-4">
                {{ $user->handle }}'s torrents
            </h2>
            @if($user->owned_torrents->count() == 0)
                <div class="text-gray-900 dark:text-gray-200 mb-4">
                    {{ $user->handle }} has not created any torrents yet.
                </div>
            @endif
            <ul class="space-y-2">
                @foreach($user->owned_torrents as $torrent)
                    <livewire:torrents.components.timeline-single :torrent="$torrent" :key="$torrent->id" />
                @endforeach
            </ul>
        </div>
    </div>
</div>