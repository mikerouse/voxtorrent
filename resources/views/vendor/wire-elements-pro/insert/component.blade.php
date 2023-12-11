<div x-data="WepInsertComponent('{{ $this->id() }}', @js($parameters))" x-cloak x-show="show">
    <div
         class="wep-insert-backdrop"
         @click="Livewire.dispatch('closeMention')"
         aria-hidden="true">
    </div>
    <div x-transition:enter="enter"
         x-transition:enter-start="start"
         x-transition:enter-end="end"
         x-transition:leave="leave"
         x-transition:leave-start="start"
         x-transition:leave-end="end"
         class="wep-insert"
         x-bind="container">

        <ul x-bind="results" class="wep-insert-results">
            @forelse($this->results as $index => $result)
                @includeIf($result['view'])
            @empty
                <li class="wep-insert-item-no-results" wire:key="no-results">
                    {{ __('wire-elements-pro::spotlight.no_matching_results') }}
                </li>
            @endforelse
        </ul>

        @if($parameters['behavior']['show_keyboard_instructions'] ?? false)
        <div class="wep-insert-instructions">
            <div>
                <div class="wep-insert-instructions-arrow-container">
                    <span class="wep-insert-instructions-arrow">
                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </span>

                    <span class="wep-insert-instructions-arrow">
                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </span>
                </div>
                <span class="wep-insert-instructions-text">
                    {{ __('wire-elements-pro::spotlight.to_navigate') }}
                </span>
            </div>
            <div>
                <span class="wep-insert-instructions-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"><path d="M392.2 25.3c-4.4 1.4-11.5 7.8-13.8 12.4-1.8 3.6-1.9 9.5-2.4 147.3l-.5 143.5-3.4 6.3c-3.8 7-6.9 10-14.5 14l-5.1 2.7-91.5.3-91.5.3 26.1-26.3c21.6-21.8 26.2-27 27.2-30.4 2.7-9.5.8-16.9-6.3-24-7.6-7.6-17.3-9.4-26.6-5-2 .9-24 22.2-51.5 49.9C87.4 367.5 88 366.7 88 376c0 9.3-.6 8.5 50.4 59.7 27.5 27.7 49.5 49 51.5 49.9 9.3 4.4 19 2.6 26.6-5 7.1-7.1 9-14.5 6.3-24-1-3.4-5.6-8.6-27.2-30.3l-26-26.2 94-.3c101.8-.4 95.2 0 110.6-5.8 7.8-2.9 19.4-10.6 26.3-17.5 6.9-6.9 14.6-18.5 17.5-26.3 5.9-15.7 5.5-3.7 5.8-160.7.2-108.6 0-145.1-.9-148.3-1.7-6.1-8.7-13.6-14.6-15.6-5.2-1.8-11.2-1.9-16.1-.3z"/></svg>
                </span>
                <span class="wep-insert-instructions-text">
                    {{ __('wire-elements-pro::spotlight.press_enter_to_select') }}
                </span>
            </div>
        </div>
        @endif
    </div>
</div>
