<div class="inline-block">
    <a href="#" wire:click.prevent="goToStage({{ $stage }})"
        class="flex items-center space-x-2 py-2 px-4 rounded-lg hover:bg-orange-300 hover:text-white transition-colors duration-200 ease-in-out" 
        id="stage-{{ $stage }}-action">
        <span class="inline-block rounded-full py-2 px-4 mr-2 {{ $active == $stage ? 'bg-orange-500 text-white' : 'bg-orange-300 bg-opacity-30 text-orange-300 text-opacity-30' }}" 
            id="stage-{{ $stage }}-number">
            {{ $stage }}
        </span>
        <span class="{{ $active == $stage ? 'text-orange-500' : 'text-orange-200 text-opacity-50' }}" id="stage-{{ $stage }}-text">
            @switch($stage)
                @case(1)
                    Issue Type
                    @break
                @case(2)
                    Issue Details
                    @break
                @case(3)
                    Decision Makers
                    @break
                @case(4)
                    Review
                    @break
                @default
                    Stage: {{ $stage }}
            @endswitch
        </span>
    </a>
</div>