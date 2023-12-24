<x-slot name="debug">
    <div wire:poll.1000ms>
        <table class="min-w-full divide-y divide-gray-200 shadow-sm overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        Issue Type</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $issueType }}</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        Stage</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $stage }}</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        Selected Decision Makers</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ var_dump($selectedDecisionMakers) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-slot>

<div class="dark:bg-transparent bg-transparent pt-14">
    <form id="createTorrent" name="createTorrent" wire:submit.prevent="submitTorrent">
        @if (session()->has('error'))
            <div class="bg-red-500 text-white px-4 py-2 rounded">
                {{ session('error') }}
            </div>
        @endif
        <div class="items-center max-w-3xl justify-center bg-transparent m-auto" id="chooseType">
            <livewire:torrents.components.create-progress :stage="$stage" />
            <div class="w-full max-w-3xl bg-transparent rounded">
                <div class="">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{ $pageTitle }}
                    </h1>
                    <p class="text-xs md:text-sm dark:text-white">
                        {{ $pageSubtitle }}
                    </p>
                </div>
                @if($stage === 1)
                    <div class="p-0" id="type-chooser-container">
                        <div class="mt-2">
                            <label for="issueType" class="p-2 block text-sm font-medium mt-4 text-gray-400 dark:text-gray-300 hidden">
                                Choose the type of issue you want to raise:
                            </label>
                            <input type="hidden" name="issueType" wire:model="issueType">
                        </div>
                        <div id="type-chooser" class="grid md:grid-cols-2 grid-cols-1 gap-4 mt-4" x-data="{ chosen: null }">
                            <div id="casework-choice" class="border rounded p-4" :class="{ 'dark:bg-orange-600 bg-orange-200': chosen === 'private' }" @click="chosen = 'private'" wire:click.prevent="setIssueType('casework')">
                                <h2 class="font-bold text-lg dark:text-white p-2">
                                    Private Casework Issue <i class="fas fa-lock fa-xs text-gray-600 ml-1"></i>
                                </h2>
                                <p class="dark:text-gray-200 p-2">
                                    This type of issue is raised privately to achieve an outcome. It's ideal for raising local or personal issues.
                                </p>
                                <button id="choose-private" class="mt-2 ml-2 bg-orange-500 text-white px-4 py-2 rounded">
                                    Choose Private</button>
                            </div>
                            <div id="petition-choice" class="border rounded p-4" :class="{ 'bg-orange-200 dark:bg-orange-600': chosen === 'public' }" @click="chosen = 'public'" wire:click.prevent="setIssueType('petition')">
                                <h2 class="font-bold text-lg dark:text-white p-2">
                                    Public Petition for Policy Change <i class="fas fa-globe fa-xs text-gray-600 ml-1"></i>
                                </h2>
                                <p class="dark:text-gray-200 p-2">
                                    These are available for anyone to support or contribute to, and are ideal for seeking changes to national or local policy.
                                </p>
                                <button id="choose-public" class="mt-2 ml-2 bg-orange-500 text-white px-4 py-2 rounded">
                                    Choose Petition</button>
                            </div>
                        </div>
                    </div>
                @endif

                @if(count($selectedDecisionMakers) > 0)
                    <div class="mt-8">
                        <div style="display: flex; flex-wrap: wrap; align-items: center;">
                            <div>
                                @switch($issueType)
                                    @case('casework')
                                        <p class="font-bold text-lg dark:text-white p-2">
                                           To:
                                        </p>
                                        @break
                                    @case('petition')
                                        <p class="font-bold text-lg dark:text-white p-2">
                                            To:
                                        </p>
                                    @break
                                @endswitch
                            </div>
                                @foreach ($selectedDecisionMakers as $id => $decisionMaker)
                                    <div class="bg-green-800" style="display: flex; align-items: center; justify-content: space-between; margin: 0px 10px 10px 0px; padding: 0px 10px 0px 0px; border-radius: 10px;">
                                        <img src="{{ $decisionMaker['thumbnail_url'] }}" alt="{{ $decisionMaker['display_name'] }}" style="width: 60px; height: 60px; border-left-radius: 10%; margin-right: 10px;">
                                        <div style="display: flex; flex-direction: column; margin-right: 10px;">
                                            <h5 class="text-white" style="margin: 0;">{{ $decisionMaker['display_name'] }}</h5>
                                            <p class="text-white text-xs">
                                                @foreach($decisionMaker->constituencies as $constituency)
                                                    @if($loop->index < 3)
                                                        {{ $constituency->name }}
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>
                                        <button wire:click="removeDecisionMaker({{ $decisionMaker['id'] }})" style="background: #f8f9fa; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; border: none;">X</button>
                                    </div>
                                @endforeach
                                <div class="flex align-middle text-center" style="align-items: center;">
                                    @if(count($selectedDecisionMakers) == 10)
                                        <p class="text-red-400 text-xs">
                                            <i class="fa fa-solid fa-exclamation-triangle"></i>
                                            You can only add 10 decision makers for now
                                        </p>
                                    @else
                                        <button wire:click.prevent="showDecisionMakerChooser" class="rounded-full px-3 py-2 text-gray-600">
                                            <i class="fa fa-solid fa-plus fa-xs"></i> add more
                                        </button>
                                    @endif
                                </div>
                        </div>
                    </div>
                @endif

                @if($showAddMore == true || $stage === 2)
                    <div class="mt-8">
                        <label for="decisionMakers" class="mt-2 block text-lg md:text-xl font-extrabold text-orange-500 dark:text-gray-300">
                            Who {{ (is_countable($selectedDecisionMakers) && count($selectedDecisionMakers) > 0) ? 'else ' : '' }}are the {{ ($issueType == 'casework' ? 'people or organisations you want to raise this issue with' : 'influencers or decision makers you want to petition') }}?
                            <p class="text-xs md:text-base text-gray-600">
                                {{ ($issueType == 'casework' ? 'Not sure? Leave it blank and we will suggest some options later.' : 'Not sure? Leave it blank and the community will suggest some options later.') }}
                            </p>
                        </label>

                        <input type="text" id="decision-maker-input" class="w-full px-4 py-2 mt-2 text-black dark:text-white dark:bg-transparent rounded-md"
                            {{ wep_insert(['decision-maker']) }} placeholder="tip: use the '@' symbol to find decision makers" />
                    </div>
                @endif

                @if(count($selectedDecisionMakers) > 0)
                    <div class="mt-4 text-right">
                        <button type="button" class="mt-2 ml-2 bg-orange-500 text-white px-4 py-2 rounded">
                            Next <i class="fa fa-solid fa-chevron-right fa-xs"></i>
                        </button>
                    </div>
                @endif

                @if($stage === 3)
                    <div class="mt-4">
                        <div id="torrent_name_container" class="mb-4">
                            <label for="torrentName" class="p-2 block text-base font-extrabold text-gray-400 dark:text-gray-300">2. Title or Subject:</label>
                            <input id="torrentName" name="torrentName" wire:model="torrentName" placeholder="sum it up in a sentence"
                                class="w-full rounded dark:text-white dark:bg-transparent" {{ wep_insert(['user', 'hashtag']) }} />
                        </div>
                    </div>
                    @if(!empty($torrentName))
                        <div class="mt-4">
                            <div id="torrent_content_container" class="mb-4">
                                <label for="torrentDescription" class="p-2 block text-sm font-medium text-gray-400 dark:text-gray-300">share your views:</label>
                                <textarea rows="6" id="torrentDescription" name="torrentDescription" wire:model="torrentDescription" placeholder="what do you want to say?"
                                    class="w-full rounded dark:text-white dark:bg-transparent" {{ wep_insert(['user', 'hashtag']) }} >
                                </textarea>
                            </div>
                        </div>
                    @endif
                @endif

                @if(!empty($torrentDescription))
                    <div class="mt-4">
                        <div id="hashtag_entry_container" class="mb-4" x-data="{ hashtags: '' }">
                            <label for="hashtags" class="p-2 block text-sm font-medium text-gray-400 dark:text-gray-300">hashtags:</label>
                            <input type="text" id="hashtags" name="hashtags" x-model="hashtags"
                                wire:model="hashtags" class="hashtags-input w-full rounded dark:text-white dark:bg-transparent" {{ wep_insert(['hashtag']) }}  
                                placeholder="#climatechange #nhs #brexit #genderdebate"/>
                        </div>
                    </div>
                @endif

                @if(!empty($torrentDescription))
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
                @endif
                @if($stage === 4)
                    <div class="mt-4 mb-1">
                        Here's what we are doing: 
                    </div>
                @endif
            </div>
        </div>
    </div>
    </form>
</div>