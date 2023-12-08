<div class="flex items-center justify-center mt-10 bg-gray-100 dark:bg-gray-900">
    <div class="w-full p-6 m-4 bg-white dark:bg-gray-800 rounded shadow-md">
        @if (!empty($selectedDecisionMakers))
        <div class="row mt-3 mb-3">
            <div class="flex items-center justify-center bg-gray-100 dark:bg-gray-200 rounded shadow-md">
                <div class="w-full p-6 bg-white dark:bg-green-300 rounded shadow-md">
                        <div class="">
                            <h3 class="text-lg font-bold">Recipients (To:)</h3>
                            <ul style="display: flex; flex-wrap: wrap;">
                                @foreach ($selectedDecisionMakers as $id => $decisionMaker)
                                    <li style="display: inline-flex; align-items: center;" class="mb-2 rounded shadow-md p-2 mr-2 bg-green-200 dark:bg-green-200">
                                        <div style="display: flex; align-items: center;">
                                            <img src="{{ $decisionMaker['thumbnail_url'] }}" alt="{{ $decisionMaker['display_name'] }}" style="width: 25px; height: 25px; border-radius: 50%; margin-right: 10px;">
                                            <div style="display: flex; align-items: center;">
                                                <h5>{{ $decisionMaker['display_name'] }}</h5>
                                                <button wire:click="removeDecisionMaker({{ $decisionMaker['id'] }})" style="background: #f8f9fa; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; border: none; margin-left: 10px;">X</button>
                                            </div>
                                        </div>
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
                </div>
            </div>
        </div>
        @endif
    </div>
</div>