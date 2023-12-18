<div class="space-y-4">
    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto">
        <livewire:torrents.components.timeline-single :torrent="$torrent" :key="$torrent->id" />
    </div>
    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto">
        <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            verified signatures by party affiliation
        </h2>
        <div class="space-y-4">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <canvas id="signaturesChart"></canvas>
            <script>
                document.addEventListener('livewire:init', function () {
      
                    var data = {
                        labels: @js(array_keys($this->signaturesByParty)),
                        datasets: [{
                            label: 'Number of Signatures',
                            data: @js(array_values($this->signaturesByParty)),
                            backgroundColor: @json($this->backgroundColors),
                            borderColor: @json($this->borderColors),
                            borderWidth: 1
                        }]
                    };

                    console.log(data); // Check the data structure

                    var ctx = document.getElementById('signaturesChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>
        </div>
        <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            why people signed
        </h2>
        <div class="p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded flex items-center mb-2">
            <i class="fas fa-info-circle mr-2"></i>
            <span>all signatures are by real id-verified people.</span>
            <span class="ml-2 text-gray-500">
                <a href="{{ route('register') }}">join voxtorrent to add yours.</a>
            </span>
        </div>
        <div class="space-y-4">
            @foreach($signatures as $signature)
            <div class="p-4 bg-white dark:bg-slate-600 rounded shadow" id="signature-user-container" x-data="{ color: '{{ $signature['signer']['primary_political_party']['brand_color_hex'] ?? '#000000' }}' }" x-bind:style="'border-right: 10px solid ' + color">
                    <div class="flex items-start space-x-2">
                        <img class="w-10 h-10 rounded-full" src="{{ sprintf('https://ui-avatars.com/api/?name=%s', urlencode($signature['signer']['name'])) }}" alt="{{ $signature['signer']['name'] }}'s photo">
                        <div class="text-sm">
                            <div class="">
                                <span class="font-bold text-gray-900 dark:text-gray-100">
                                    {{ $signature['signer']['name'] }}
                                </span>
                                <span class="ml-2 text-gray-400">
                                    <a href="/{{ $signature['signer']['handle'] }}">{{ '@' . $signature['signer']['handle'] }}</a>
                                </span>
                            </div>
                            <p class="text-gray-700 dark:text-gray-100 text-lg">{{ $signature['reason_for_signing'] }}</p>
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-gray-500">
                        Signed {{ $signature['created_at'] }}
                    </div>
                </div>
                <div>

                </div>
            @endforeach
            <div>
                <button wire:click="goToPage(1)">1</button>
                <button wire:click="goToPage(2)">2</button>
            </div>
        </div>
    </div>
    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto">
        @auth
        <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            add your voice to this torrent
        </h2>
        <div class="relative bg-blue-50 p-6 rounded-lg shadow-md text-blue-800">
            <button class="absolute top-2 right-2 text-blue-800 hover:text-blue-600" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
            <p class="text-lg mb-4">voxtorrent is different; we don't send the same old copied and pasted text to decision-makers, which they ignore.</p>
            <p class="text-lg mb-4">if a picture speaks a thousand words imagine how much impact a voice note or video will have.</p>
            <p class="text-lg mb-4">adding a comment, voice note, picture or video to a torrent uses your verified identity associated with your voxtorrent account - this is how decision-makers will be assured that the issue is being backed by real people.</p>
            <p class="text-lg mb-4">if you don't want the dedcision-maker to know your identity, you can use the like, neutral or dislike buttons to signal your position anonymously.</p>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                learn more <i class="fa-solid fa-up-right-from-square"></i>
            </button><span class="p-1 pl-4 text-gray-500">this button will take you to our learning zone</span>
        </div>
        <div id="torrent-signature-container" class="space-y-4">
            <form action="/upload" method="post" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="voice-note" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-microphone"></i> Voice Note
                    </label>
                    <input type="file" id="voice-note" name="voice-note" accept="audio/*" class="mt-1 block w-full">
                </div>
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-image"></i> Photo
                    </label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="mt-1 block w-full">
                </div>
                <div>
                    <label for="video" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-video"></i> Video
                    </label>
                    <input type="file" id="video" name="video" accept="video/*" class="mt-1 block w-full">
                </div>
                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-comment"></i> Comment
                    </label>
                    <textarea id="comment" name="comment" rows="3" class="mt-1 block w-full"></textarea>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        @endauth
        @guest
        <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            log in to add your voice to this torrent
        </h2>
        @endguest
    </div>
</div>
