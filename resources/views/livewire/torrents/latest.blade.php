@php
function formatNumber($number) {
    if ($number >= 1000 && $number < 1000000) {
        return number_format($number / 1000, 1) . 'K';
    } elseif ($number >= 1000000) {
        return number_format($number / 1000000, 1) . 'M';
    } else {
        return $number;
    }
}
@endphp
<div class="space-y-4">

    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto" id="torrent-list-container">

        <div class="w-full mx-auto sm:px-6 lg:px-8 justify-center" id="#torrent-list-container">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">

                    <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __("latest") }}
                    </h2>

                    @foreach($this->torrents as $torrent)
                        <div class="border dark:border-slate-500 rounded-md mb-4">
                            <div id="torrent-owner-name-and-photo-container" class="flex items-center space-x-2 p-4 dark:bg-gray-800 bg-white">
                                <img class="w-15 h-15 rounded-full" src="{{ sprintf('https://ui-avatars.com/api/?name=%s', urlencode($torrent->owner->name)) }}" alt="{{ $torrent->owner->name }}'s photo">
                                <span>
                                    <div class="font-bold">
                                        {{ $torrent->owner->name }} 
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
                                        <span class="text-xs mr-4 text-gray-500">{{ $torrent->created_at->diffForHumans() }}</span>
                                        <span class="text-xs text-gray-500">{{ formatNumber($torrent->views) }} views</span>
                                    </div>
                                </span>
                            </div>
                            <div id="torrent-decision-makers" class="flex flex-wrap p-4">
                                @php
                                    $displayDecisionMakers = $torrent->decision_makers->sortBy('weight')->take(3);
                                    $remainingCount = $torrent->decision_makers->count() - 3;
                                @endphp
                                
                                @foreach($displayDecisionMakers as $decisionMaker)
                                    <span class="inline-flex items-center pr-2.5 py-0 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2 mb-2">
                                        <img class="w-8 h-8 rounded-full mr-1.5" src="{{ $decisionMaker->thumbnail_url }}" alt="{{ $decisionMaker->display_name }}'s photo">
                                        {{ $decisionMaker->display_name }}
                                    </span>
                                @endforeach
                                
                                @if($remainingCount > 0)
                                    <a href="#" class="inline-flex items-center text-xs font-medium text-gray-200">
                                        and {{ $remainingCount }} more...
                                    </a>
                                @endif
                            </div>
                            <div class="text-gray-600 dark:text-gray-400 text-lg bg-white dark:bg-gray-800 p-4">
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
                            <div class="flex w-full h-2" id="likes-by-party-percentages-bar">
                                <div class="bg-blue-500" style="width: {{ rand(10, 80) }}%"></div>
                                <div class="bg-red-500" style="width: {{ rand(10, 80) }}%"></div>
                                <div class="bg-yellow-500" style="width: {{ rand(10, 80) }}%"></div>
                                <div class="bg-purple-500" style="width: {{ rand(10, 80) }}%"></div>
                                <div class="bg-green-500" style="width: {{ rand(10, 80) }}%"></div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

</div>