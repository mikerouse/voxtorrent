<div>


    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md p-6 m-4 bg-white dark:bg-gray-800 rounded shadow-md">

            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                <span class="text-red-500 dark:text-red-500">who</span> do we need to convince?
            </h1>

            @if (!empty($selectedDecisionMakers))
            <div class="row mt-3 mb-3">
                <div class="flex items-center justify-center bg-gray-100 dark:bg-gray-200 rounded shadow-md">
                    <div class="w-full max-w-md p-6 bg-white dark:bg-green-300 rounded shadow-md">
                            <div class="">
                                <h3 class="text-lg font-bold">Recipients (To:)</h3>
                                <ul>
                                    @foreach ($selectedDecisionMakers as $id => $decisionMaker)
                                        <li style="display: flex; align-items: center; justify-content: space-between;" class="mb-2 rounded shadow-md p-2 bg-green-200 dark:bg-green-200">
                                            <div style="display: flex; align-items: center;">
                                                <img src="{{ $decisionMaker['thumbnail_url'] }}" alt="{{ $decisionMaker['display_name'] }}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
                                                <div style="display: flex; flex-direction: column;">
                                                    <h5>{{ $decisionMaker['display_name'] }}</h5>
                                                    <p class="text-sm text-gray-500 uppercase">{{ $decisionMaker['constituency'] }}</p>
                                                    <p class="text-xs text-gray-500 uppercase">{{ $decisionMaker['constituency_type'] }}</p>
                                                </div>
                                            </div>
                                            <button wire:click="removeDecisionMaker({{ $decisionMaker['id'] }})" style="background: #f8f9fa; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; border: none;">X</button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div>
                                @if (session()->has('error'))
                                    <div class="bg-red-500 text-white px-4 py-2 rounded">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            <button wire:click="goToStep2" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">next: the ask</button>
                    </div>
                </div>
            </div>
            @endif

            <form class="mt-4">
                <div class="mb-4">
                    <label for="decisionMakers" class="block text-gray-700 dark:text-gray-300">Start typing to find decision makers</label>
                    <input type="text" id="decisionMakers" wire:model="search" wire:keyup="performSearch" required class="w-full px-4 py-2 mt-2 text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-gray-300 rounded-md focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                    @if (!empty($searchResults))
                        <div class="mt-2 p-2 bg-white dark:bg-gray-900 border rounded shadow overflow-hidden">
                            @foreach ($searchResults as $result)
                                <a href="#" wire:click.prevent="addDecisionMaker({{ $result->id }})" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-900 text-gray-800 dark:text-gray-100">{{ $result->display_name }}</a>
                            @endforeach
                        </div>
                    @endif
                    <p class="text-gray-500 dark:text-gray-300; text-sm py-2">Tip: You can type the name of a Member of Parliament, a Councillor, or an organisation.</p>
                </div>
               
            </form>
        </div>
    </div>

</div>


