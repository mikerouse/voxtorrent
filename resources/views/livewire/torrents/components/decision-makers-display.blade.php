<div id="torrent-decision-makers" class="flex flex-wrap p-4">
    @php
        $displayDecisionMakers = $torrent->decision_makers->sortBy('weight')->take(3);
        $remainingCount = $torrent->decision_makers->count() - 3;
    @endphp
    
    @foreach($displayDecisionMakers as $decisionMaker)
        <span class="inline-flex items-center pr-2.5 py-0 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2 mb-2">
            <img class="w-8 h-8 rounded-full mr-1.5" src="{{ $decisionMaker->thumbnail_url }}" alt="{{ $decisionMaker->display_name }}'s photo">
            {{ $decisionMaker->display_name }}
        </span>
    @endforeach
    
    @if($remainingCount > 0)
        <a href="#" class="inline-flex items-center text-xs font-medium text-gray-200">
            and {{ $remainingCount }} more...
        </a>
    @endif
</div>