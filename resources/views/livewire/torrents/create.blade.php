<div class="flex flex-col space-y-4 mt-7 dark:bg-gray-800 bg-white">
    <form id="createTorrent" name="createTorrent" wire:submit.prevent="submitTorrent">
        @if (session()->has('error'))
                <div class="bg-red-500 text-white px-4 py-2 rounded">
                    {{ session('error') }}
                </div>
            @endif
    <div class="flex items-center justify-center bg-white dark:bg-gray-800" id="chooseWhat">
        <div class="w-full max-w-xl bg-white dark:bg-gray-800 rounded shadow-md">
            <div class="px-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    <span class="text-red-500 dark:text-red-500">start</span> a torrent
                </h1>
                <p class="text-sm text-gray-600">what? why? </p>
                <div>
                    @error('selectedDecisionMakers')
                        <span class="error">{{ $message }}</span>
                    @enderror

                    @error('torrentDescription')
                        <span class="error">{{ $message }}</span>
                    @enderror

                    @error('hashtags')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="px-4">
                <div class="mt-2">
                    <div style="display: flex; flex-wrap: wrap; align-items: center;">
                        @foreach ($selectedDecisionMakers as $id => $decisionMaker)
                            <div class="bg-green-200" style="display: flex; align-items: center; justify-content: space-between; margin-right: 10px; margin-bottom: 10px; padding: 5px 10px; border-radius: 20px;">
                                <img src="{{ $decisionMaker['thumbnail_url'] }}" alt="{{ $decisionMaker['display_name'] }}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                                <div style="display: flex; flex-direction: column; margin-right: 10px;">
                                    <h5 style="margin: 0;">{{ $decisionMaker['display_name'] }}</h5>
                                </div>
                                <button wire:click="removeDecisionMaker({{ $decisionMaker['id'] }})" style="background: #f8f9fa; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; border: none;">X</button>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4">
                    <input type="text" id="decisionMakers" wire:model="searchText" wire:keyup="performSearch" 
                    placeholder="who {{ (is_countable($selectedDecisionMakers) && count($selectedDecisionMakers) > 0) ? 'else ' : '' }}are you trying to influence?"
                    class="w-full px-4 py-2 mt-2 text-black dark:text-white dark:bg-transparent rounded-md"
                    x-data x-on:refresh.window="$el.value = ''">
                    <label for="decisionMakers" class="p-2 block text-sm font-medium text-gray-400 dark:text-gray-300">tip: you can choose members of parliament, your councillors, whole councils or their departments, utlity providers, developers, charities - almost anything</label>
                    @if (!empty($searchResults))
                        <div class="mt-2 p-2 bg-white dark:bg-gray-900 border rounded shadow overflow-hidden">
                            @foreach ($searchResults as $result)
                                <a href="#" wire:click.prevent="addDecisionMaker({{ $result->id }})" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-900 text-gray-800 dark:text-gray-100">
                                    {{ $result->display_name }} <span class="text-gray-400">({{ $result->constituencies_list }})</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="mt-4">
                    <div id="torrent_content_container" class="mb-4">
                        <label for="torrentDescription" class="p-2 block text-sm font-medium text-gray-400 dark:text-gray-300">share your views:</label>
                        <textarea rows="6" id="torrentDescription" name="torrentDescription" wire:model="torrentDescription" placeholder="what do you want to say?"
                            class="w-full rounded dark:text-white dark:bg-transparent" {{ wep_insert(['user', 'hashtag']) }} >
                        </textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <div id="hashtag_entry_container" class="mb-4" x-data="{ hashtags: '' }">
                        <label for="hashtags" class="p-2 block text-sm font-medium text-gray-400 dark:text-gray-300">hashtags:</label>
                        <input type="text" id="hashtags" name="hashtags" x-model="hashtags"
                            wire:model="hashtags" class="hashtags-input w-full rounded dark:text-white dark:bg-transparent" {{ wep_insert(['hashtag']) }}  
                            placeholder="#climatechange #nhs #brexit #genderdebate"/>
                    </div>
                </div>
                <div class="mt-4 mb-1">
                    <div class="">
                        <div id="upload_tip">
                            <label for="uploads" class="p-2 block text-sm font-medium text-gray-400 dark:text-gray-300">attach something - why not add a voice note or a video:</label>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-4">
                                <button class="bg-gray-300 dark:bg-gray-600 rounded-full px-3 py-2">
                                    <i class="fas fa-image text-gray-700 dark:text-gray-300"></i>
                                </button>
                                <button class="bg-gray-300 dark:bg-gray-600  rounded-full px-3 py-2">
                                    <i class="fas fa-microphone text-gray-700 dark:text-gray-300"></i>
                                </button>
                                <button class="bg-gray-300 dark:bg-gray-600  rounded-full px-3 py-2">
                                    <i class="fas fa-video text-gray-700 dark:text-gray-300"></i>
                                </button>
                                <button class="bg-gray-300 dark:bg-gray-600  rounded-full px-4 py-2">
                                    <i class="fas fa-location-dot text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                            <div class="flex justify-between items-center">
                                <div id="charCount" class="text-gray-400 mr-2 text-sm">
                                    <span class="text-gray-400" id="counter" wire:ignore>0</span>
                                </div>
                                <button id="submitTorrent" name="submitTorrent" type="submit" @click="submitTorrent"
                                        class="{{ $isFormValid ? 'bg-blue-500' : 'bg-gray-500' }} text-white rounded py-2 px-4 text-sm"
                                        {{ $isFormValid ? 'disabled' : '' }}>
                                    post <i class="fas fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="">
                           
                        </div>
                    </div>
  
                </div>

                <div class="p-2 m-0 dark:text-gray-300 text-sm">
                    @if(!is_string($hashtags) && $hashtags !== null && count($hashtags) > 0)
                        <span class="text-gray-400">topics: </span>
                        @foreach($hashtags as $hashtag)
                            <span class="bg-gray-200 dark:bg-gray-700 rounded-full px-2 py-1 mr-1">{{ $hashtag }}</span>
                        @endforeach
                    @else
                        <span class="text-gray-400">
                            tip: you need to use at least 1 hashtag to be able to post your torrent 
                        </span>
                    @endif
                </div>

         

            </div>
            <div class="bg-gray-100 dark:bg-gray-700">
                <div class="p-6">
                    <ul class="flex space-x-4">
                        <li class="dark:text-white text-gray-500">Trending tags: </li>
                        <li class="dark:text-white text-gray-500">#stoptheboats <i class="fa-solid fa-arrow-trend-up text-green-500"></i></li>
                        <li class="dark:text-white text-gray-500">#nhspay <i class="fa-solid fa-arrow-trend-up text-green-500"></i></li>
                        <li class="dark:text-white text-gray-500">#bringbackboris <i class="fa-solid fa-arrow-trend-down text-red-500"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>