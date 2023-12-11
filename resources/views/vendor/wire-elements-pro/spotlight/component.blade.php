<div class="wep-spotlight"
     x-data="WepSpotlightComponent('{{ $this->id() }}')"
     x-trap="active"
     x-cloak>

    <div
        x-transition:enter="enter"
        x-transition:enter-start="start"
        x-transition:enter-end="end"
        x-transition:leave="leave"
        x-transition:leave-start="start"
        x-transition:leave-end="end"
        class="wep-spotlight-backdrop"
        x-show="active"></div>

    <div class="wep-spotlight-outer-container" x-show="active">
        <div
        x-transition:enter="enter"
        x-transition:enter-start="start"
        x-transition:enter-end="end"
        x-transition:leave="leave"
        x-transition:leave-start="start"
        x-transition:leave-end="end"
        class="wep-spotlight-inner-container"
        @keydown.window.prevent.escape="close()"
        @click.outside="close()"
        @foreach($this->config('default-behavior.shortcuts', []) as $key)
        @keydown.window.prevent.cmd.{{ $key }}="toggle()"
        @keydown.window.prevent.ctrl.{{ $key }}="toggle()"
        @endforeach
        x-show="active">
            <div class="wep-spotlight-input-container">
                <div class="wep-spotlight-input-icon">
                    <svg wire:loading.delay aria-label="Loading" class="wep-spotlight-input-loading-icon" viewBox="0 0 16 16" fill="none" width="16" height="16">
                        <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-opacity="0.25" stroke-width="2" vector-effect="non-scaling-stroke"></circle>
                        <path d="M15 8a7.002 7.002 0 00-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" vector-effect="non-scaling-stroke"></path>
                    </svg>

                    <svg wire:loading.delay.remove class="wep-spotlight-input-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                @if($this->activeTokens->isNotEmpty())
                    <div class="wep-spotlight-token-container" wire:key="spotlight-tokens">
                        @foreach($this->activeTokens as $token)
                            <div class="wep-spotlight-token">
                                {{ $token->text }}
                            </div>
                            <div class="wep-spotlight-token-divider">
                                /
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="wep-spotlight-input-inner-container" wire:key="spotlight-input">
                    <div x-show="query || tokens.length > 0" class="wep-spotlight-input-escape" x-cloak>
                        <button @click="resetQuery();resetScope();" type="button" tabindex="-1">
                            <svg class="wep-spotlight-input-escape-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                    <input type="text" tabindex="0" x-bind="input" wire:model.live.debounce.{{ $this->config('default-behavior.debounce_milliseconds') }}ms="query" x-bind:placeholder="selection()?.typeahead ?? selection()?.title ?? '{{ __('wire-elements-pro::spotlight.search_or_jump_to') }}'" class="wep-spotlight-input">
                </div>
            </div>
            @if($initialised && isset($this->results))
                <div class="wep-spotlight-groups" x-ref="resultGroups" wire:key="spotlight-results">
                    @forelse($this->results as $groupIndex => $group)
                        <div class="wep-spotlight-group" wire:key="spotlight-result-group-{{ $groupIndex }}">
                            <h2 class="wep-spotlight-group-title">{{ $group->title() }}</h2>

                            <ul x-ref="results">
                                @foreach($group->items() as $index => $item)
                                    <x-wire-elements-pro::spotlight-item :item="$item" :index="$loop->index" :parent="$loop->parent->index">
                                        @includeIf($item->view())
                                    </x-wire-elements-pro::spotlight-item>
                                @endforeach
                            </ul>
                        </div>
                    @empty
                        @includeIf('wire-elements-pro::spotlight.no-results')
                    @endforelse
                </div>
                @if($tip || $helpers)
                    <div class="wep-spotlight-footer">
                        @if($tip)
                            <div class="wep-spotlight-footer-tip">
                                <span class="wep-spotlight-footer-tip-label">{{ __('wire-elements-pro::spotlight.tip') }}:</span>
                                {!! $tip !!}
                            </div>
                        @endif

                        @if($helpers)
                            <div class="wep-spotlight-footer-helper">
                                {{ __('wire-elements-pro::spotlight.tip') }} <kbd class="wep-spotlight-footer-helper-key">?</kbd> {{ __('wire-elements-pro::spotlight.for_help_and_tips') }}
                            </div>
                        @endif
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
