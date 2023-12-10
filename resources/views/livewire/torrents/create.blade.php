<div class="flex flex-col space-y-4">
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900" id="chooseWhat">
        <div class="w-full max-w-xl m-4 bg-white dark:bg-gray-800 rounded shadow-md">
            <div class="px-6 pt-4">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    <span class="text-red-500 dark:text-red-500">start</span> a torrent
                </h1>
            </div>
            <div class="px-6">
                <div class="mt-4">
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
                    placeholder="Who do you want to convince?"
                    class="w-full px-4 py-2 mt-2 text-gray-700 dark:text-gray-300 rounded-md focus:outline-none"
                    x-data x-on:refresh.window="$el.value = ''">
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
                    <div class="relative">
                        <div id="highlightedContent" class="absolute top-0 left-0 px-3 py-1 mt-2 overflow-hidden dark:text-white bg-transparent rounded-md pointer-events-none"></div>
                        <textarea id="torrentDescription" wire:model="torrentDescription" oninput="updateCount()" 
                        rows="5" placeholder="What's the cause? Why does it matter?"
                        class="w-full px-3 py-1 mt-2 bg-transparent text-transparent dark:bg-gray-700 rounded-md focus:outline-none focus:bg-white dark:focus:bg-gray-800"></textarea>
                    </div>
                </div>
                <div class="p-2 m-0 dark:text-gray-300 text-sm">tip: record a voice note or video to make your torrent even stronger</div>
                <div class="mt-2 mb-4">
                    
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
                                <span class="text-gray-400">0/512</span>
                            </div>
                            <button id="nextButton" class="bg-blue-500 text-white rounded py-2 px-4 text-sm" onclick="document.getElementById('preparingTorrent').scrollIntoView({ behavior: 'smooth' });">
                                next <i class="fa-solid fa-angle-right"></i>
                            </button>
                        </div>
                        <script>
                            function updateCount() {
                                var textArea = document.getElementById('torrentDescription');
                                var highlightedContent = document.getElementById('highlightedContent');
                                var charCount = document.getElementById('charCount');
                                var nextButton = document.getElementById('nextButton');
                                var length = textArea.value.length;
                                if (length > 512) {
                                    charCount.className = 'text-red-500 mr-2 text-sm';
                                    nextButton.disabled = true;
                                    nextButton.className = 'bg-gray-500 text-white rounded py-2 px-4 text-sm';
                                } else if (length > 412) {
                                    charCount.className = 'text-yellow-500 mr-2 text-sm';
                                    nextButton.disabled = false;
                                    nextButton.className = 'bg-blue-500 text-white rounded py-2 px-4 text-sm';
                                } else {
                                    charCount.className = 'text-gray-400 mr-2 text-sm';
                                    nextButton.disabled = false;
                                    nextButton.className = 'bg-blue-500 text-white rounded py-2 px-4 text-sm';
                                }
                                charCount.textContent = length + '/512';
                                highlightedContent.innerHTML = textArea.value.replace(/(#\w+)/g, '<span style="color: orange;">$1</span>').replace(/\n/g, '<br/>');
                            }
                            document.getElementById('torrentDescription').addEventListener('input', updateCount);
                        </script>
                    </div>
  
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
            @if (session()->has('error'))
                <div class="bg-red-500 text-white px-4 py-2 rounded">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900" id="preparingTorrent">
        <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="w-full max-w-xl p-6 mt-4 ml-4 mb-4 mr-1 bg-white dark:bg-gray-800 rounded shadow-md">
    
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    unleash your torrent ...
                </h1>
    
                <div class="row mt-3 mb-3">
                    <div class="bg-orange-500 dark:bg-orange-700 rounded shadow-md text-white">
                        <div class="w-full max-w-xl rounded p-5">
                            <div class="">
                                <p class="text-md font-bold">get people to sign or like:</p>
                                <input type="text" readonly class="w-full mt-2 mb-1 px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" value="{{ url('/torrents/' . $torrent->id) }}" onclick="this.select();">
                                <p class="text-xs text-white my-2">anyone with this link can sign your torrent, just like a petition</p>
                            </div>
                        </div>
    
                        <div class="w-full max-w-xl p-5 bg-orange-400 rounded shadow-md">
                            <div class="">
                                <p class="text-md font-bold">share to your socials</p>
                                <div class="flex space-x-4 mt-4">
                                    <button class="bg-gray-500 rounded-full p-2 px-4">
                                        <i class="fa-brands fa-facebook-f text-white"></i>
                                    </button>
                                    <button class="bg-gray-500 rounded-full p-2 px-4">
                                        <i class="fa-brands fa-twitter text-white"></i>
                                    </button>
                                    <button class="bg-gray-500 rounded-full p-2 px-4">
                                        <i class="fa-brands fa-instagram text-white"></i>
                                    </button>
                                    <button class="bg-gray-500 rounded-full p-2 px-4">
                                        <i class="fa-brands fa-linkedin-in text-white"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row mt-3 mb-3 text-right">
                    <div class="rounded mt-2">
                        <div class="w-full max-w-xl p-0 mt-3 bg-white rounded">
                            <div class="pt-2">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded">view voxtorrent</button>
                                <button class="bg-gray-200 text-gray-900 px-4 py-2 rounded">make changes</button>
                            </div>
                            <div class="pt-4 text-xs lowercase text-gray-400">
                                <a href="">support free software: donations welcome</a>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 hidden md:flex" id="infoSlides">
            <div class="bg-gray-100 dark:bg-gray-200 rounded">
    
                <div x-data="{ step: 0 }" x-init="setInterval(() => { step = (step + 1) % 3 }, 5000)">
                    <div class="w-full max-w-md p-6 rounded" 
                         x-show="step === 0" 
                         x-transition:enter="transition ease-in duration-1000 transform" 
                         x-transition:enter-start="opacity-0 scale-90" 
                         x-transition:enter-end="opacity-100 scale-100" 
                         x-transition:leave="transition ease-out duration-1000 transform" 
                         x-transition:leave-start="opacity-100 scale-100" 
                         x-transition:leave-end="opacity-0 scale-90" 
                         id="info1">
                         <div class="">
                            <p class="text-md font-bold">what happens next?</p>
                            <p>if people agree with your voxtorrent we'll start engaging decision makers on your behalf.</p>
                        </div>
                    </div>
                    <div class="w-full max-w-md p-6 rounded" 
                         x-show="step === 1" 
                         x-transition:enter="transition ease-in duration-1000 transform" 
                         x-transition:enter-start="opacity-0 scale-90" 
                         x-transition:enter-end="opacity-100 scale-100" 
                         x-transition:leave="transition ease-out duration-1000 transform" 
                         x-transition:leave-start="opacity-100 scale-100" 
                         x-transition:leave-end="opacity-0 scale-90" 
                         id="info2">
                         <div class="">
                            <p class="text-md font-bold">get signatures and likes</p>
                            <p>the more people who sign your torrent, or hit the like button, the bigger your torrent becomes -- and the harder it is to ignore. But remember - people can disagree with it too.</p>
                        </div>
                    </div>
                    <div class="w-full max-w-md p-6 rounded" 
                         x-show="step === 2" 
                         x-transition:enter="transition ease-in duration-1000 transform" 
                         x-transition:enter-start="opacity-0 scale-90" 
                         x-transition:enter-end="opacity-100 scale-100" 
                         x-transition:leave="transition ease-out duration-1000 transform" 
                         x-transition:leave-start="opacity-100 scale-100" 
                         x-transition:leave-end="opacity-0 scale-90" 
                         id="info3">
                         <div class="">
                            <p class="text-md font-bold">what's a decision maker?</p>
                            <p>decision makers are people who can make a difference. They can be politicians, business leaders, or anyone with the power to change things (or the power to maintain a status quo if that's what you want).</p>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>

