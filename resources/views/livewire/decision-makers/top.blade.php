<div class="max-w-3xl m-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 justify-center">
        @foreach($influencers as $influencer)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img class="w-full h-64 object-cover" src="{{ $influencer->thumbnail_url }}" alt="{{ $influencer->name }}">
                <div class="p-4">
                    <h2 class="text-lg font-bold">
                        {{ $influencer->display_name }}
                    </h2>
                    <p class="text-gray-700">
                        @foreach($influencer->constituencies as $constituency)
                            {{ $constituency->name }}
                            @if(!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </p>
                    <div class="mt-2">
                        <div class="flex items-center space-x-2">
                            <span class="inline-block text-xs">
                                <div class="h-5 w-5 rounded-full 
                                    {{ $influencer->current_party == 'Conservative' ? 'bg-blue-500' : 
                                        ($influencer->current_party == 'Labour' ? 'bg-red-500' : 
                                        ($influencer->current_party == 'Labour (Co-op)' ? 'bg-red-500' : 
                                        ($influencer->current_party == 'Scottish National Party' ? 'bg-orange-500' : 
                                        ($influencer->current_party == 'Liberal Democrat' ? 'bg-yellow-500' : 'bg-white')))) }}">
                                </div>
                            </span>
                            <span class="inline-block bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-xs font-semibold tracking-wide">{{ $influencer->torrents_count }} Torrents</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>