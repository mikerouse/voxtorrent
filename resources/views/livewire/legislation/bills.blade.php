<div class="space-y-4">
    <div class="max-w-3xl mt-1 tems-center justify-center items-center m-auto" id="bills-list-container">
        <div class="w-full mx-auto sm:px-6 lg:px-8 justify-center">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __("parliamentary bills") }}
                    </h2>
                    @foreach($bills as $bill)
                    <div class="bill-container border dark:border-slate-500 mb-5">
                        <div class="border dark:border-slate-500 p-5">
                            @if(count($bill->sponsors) > 0)
                                <div class="float-right">
                                    @foreach($bill->sponsors as $sponsor)
                                        <a href="{{ route('decisionmaker', $sponsor->id) }}" class="inline-block">
                                            <img src="{{ $sponsor->thumbnail_url }}" alt="{{ $sponsor->display_name }}" 
                                                class="w-28 h-28 rounded-full inline-block border-8" style="border-color: {{  $sponsor->political_parties[0]->brand_color_hex }}">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            <h2 class="text-xl font-bold dark:text-white mb-2">
                                {{ $bill->shortTitle }}
                            </h2>
                            <div>
                                <p>
                                    {{ $bill->longTitle }}
                                </p>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 flex">
                                @if($bill->currentHouse == 'Commons')
                                    <span class="rounded-full bg-green-800 w-6 h-6 flex items-center justify-center inline-block mr-2">
                                        <i class="fas fa-house-user fa-xs text-white"></i> 
                                    </span>
                                @elseif($bill->currentHouse == 'Lords')
                                    <span class="rounded-full bg-red-800 w-6 h-6 flex items-center justify-center inline-block mr-2">
                                        <i class="fas fa-church fa-xs text-white"></i> 
                                    </span>
                                @elseif($bill->currentStage['description'] == 'Royal Assent')
                                    <span class="rounded-full bg-purple-800 w-6 h-6 flex items-center justify-center inline-block mr-2">
                                        <i class="fas fa-crown fa-xs text-white"></i> 
                                    </span>
                                @endif
                                {{ $bill->billType->name }}
                            </p>
                            <div class="bill-meta-bar mt-2">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <strong>Current Stage: </strong>
                                    {{ $bill->currentStage['description'] }}
                                </p>
                                @if(count($bill->sponsors) > 0)
                                    <p class="text-gray-700 dark:text-gray-300">
                                        <strong>Sponsor(s): </strong>
                                        @foreach($bill->sponsors as $sponsor)
                                            <a href="{{ route('decisionmaker', $sponsor->id) }}" class="inline-block">
                                                {{ $sponsor->display_name }}
                                            </a>
                                            @if(!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="bill-footer-container border dark:border-slate-500 p-5">
                          
                            <div class="p-2 bg-white dark:bg-transparent flex justify-between" id="torrent-bottom-bar-container">
                                <button class="inline-flex items-center space-x-2 mr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                                    <i class="fas fa-smile fa-lg text-green-200"></i>
                                    <span>
                                        <div>
                                            {{ number_format(rand(100, 10000)) }}
                                        </div>
                                    </span>
                                </button>
                                <button class="inline-flex items-center space-x-2 mr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                                    <i class="fas fa-meh fa-lg text-gray-200"></i>
                                    <span>
                                        {{ number_format(rand(100, 10000)) }}
                                    </span>
                                </button>
                                <button class="inline-flex items-center space-x-2 mr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                                    <i class="fas fa-frown fa-lg text-red-200"></i>
                                    <span>{{ number_format(rand(100, 10000)) }}</span>
                                </button>
                                <span class="inline-flex items-center space-x-2 mr-3 text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-bookmark fa-lg text-gray-200"></i>
                                    <span>1234</span>
                                </span>
                                <span class="inline-flex items-center space-x-2 mr-3 text-gray-500 dark:text-gray-400">
                                    <i class="fa-solid fa-arrow-up-from-bracket text-gray-200"></i>
                                    <span>1234</span>
                                </span>   
                            </div>

                        </div>
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
    <div class="w-full py-6 flex justify-center">
        {{ $bills->links() }}
    </div>
</div>