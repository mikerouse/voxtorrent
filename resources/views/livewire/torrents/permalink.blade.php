<div class="space-y-4">
    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto">
        <livewire:torrents.components.timeline-single :torrent="$torrent" :key="$torrent->id" />
    </div>
    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto">
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
    </div>
</div>
