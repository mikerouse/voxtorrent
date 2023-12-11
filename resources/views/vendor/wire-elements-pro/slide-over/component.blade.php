<div x-data="WepOverlayComponent({ type: 'slide-over', animationOverlapDuration: 500 })"
     @keydown.window.escape="closeIf('close-on-escape')"
     x-show="open"
     class="wep-slide-over"
     :class="{ [getElementAttribute('component-class')]: true, 'wep-slide-over-top': onTop }"
     aria-modal="true"
     x-cloak>
    <div x-show="open"
         @click="open = false"
         x-transition:enter="enter"
         x-transition:enter-start="start"
         x-transition:enter-end="end"
         x-transition:leave="leave"
         x-transition:leave-start="start"
         x-transition:leave-end="end"
         class="wep-slide-over-backdrop"
         aria-hidden="true">
    </div>

    <div class="wep-slide-over-container">
        <div class="wep-slide-over-container-backdrop" @click="closeIf('close-on-backdrop-click')" aria-hidden="true"></div>
        <div class="wep-slide-over-container-inner">
            <div x-show="open && showActiveComponent"
                 x-trap.inert.noscroll="getElementBehavior('trap-focus') && open"
                 x-transition:enter="enter"
                 x-transition:enter-start="start"
                 x-transition:enter-end="end"
                 x-transition:leave="leave"
                 x-transition:leave-start="start"
                 x-transition:leave-end="end"
                 x-bind:class="activeComponentWidth"
                 class="wep-slide-over-container-inner-wrap">

                @foreach($components as $id => $component)
                    <div x-show.immediate="activeComponent === '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}" class="wep-slide-over-container-inner-content">
                        @livewire($component['name'], $component['arguments'], key($id))
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
