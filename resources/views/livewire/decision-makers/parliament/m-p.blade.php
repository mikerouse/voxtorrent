<div class="space-y-4">
    <div class="max-w-3xl mt-1 tems-center justify-center items-center m-auto" id="bills-list-container">
        <div class="w-full mx-auto sm:px-6 lg:px-8 justify-center">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <div class="float-right">
                        <a href="" class="inline-block">
                            <img src="{{ $mp->thumbnail_url }}" alt="{{ $mp->display_name }}" class="w-20 h-20 rounded-full inline-block border-2" style="border-color: {{ $mp->political_parties[0]->brand_color_hex }}">
                        </a>
                    </div>
                    <h1 class="mt-4 font-light text-xl text-gray-500 dark:text-gray-300 leading-tight">
                        {{ __("member of parliament") }}
                    </h1>
                    <h2 class="mt-1 font-bold text-2xl text-green-800 dark:text-green-600">
                        {{ strtoupper($mp->display_name) }}
                    </h2>
                    <div class="mt-2">
                        <span>
                            <a href="" class="inline-block">
                                <img src="{{ $mp->political_parties[0]->logo_url }}" alt="{{ $mp->political_parties[0]->name }}" class="w-10 h-10 rounded-full inline-block border-2" style="border-color: {{ $mp->political_parties[0]->brand_color_hex }}">
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>