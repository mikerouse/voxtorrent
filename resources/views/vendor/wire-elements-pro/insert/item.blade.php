<x-wire-elements-pro::insert-item :item="$result" :index="$loop->index">
    <div class="wep-insert-item-inner">
        @if($result['photo'])
            <img src="{{ $result['photo'] }}" alt="" class="wep-insert-item-inner-photo">
        @endif
        @if($result['headline'])
        <span class="wep-insert-item-inner-headline">{{ $result['headline'] }}</span>
        @endif
        @if($result['subheadline'])
            <span class="wep-insert-item-inner-subheadline">{{ $result['subheadline'] }}</span>
        @endif

        <svg xmlns="http://www.w3.org/2000/svg" class="wep-insert-item-enter-icon" viewBox="0 0 512 512" fill="currentColor"><path d="M392.2 25.3c-4.4 1.4-11.5 7.8-13.8 12.4-1.8 3.6-1.9 9.5-2.4 147.3l-.5 143.5-3.4 6.3c-3.8 7-6.9 10-14.5 14l-5.1 2.7-91.5.3-91.5.3 26.1-26.3c21.6-21.8 26.2-27 27.2-30.4 2.7-9.5.8-16.9-6.3-24-7.6-7.6-17.3-9.4-26.6-5-2 .9-24 22.2-51.5 49.9C87.4 367.5 88 366.7 88 376c0 9.3-.6 8.5 50.4 59.7 27.5 27.7 49.5 49 51.5 49.9 9.3 4.4 19 2.6 26.6-5 7.1-7.1 9-14.5 6.3-24-1-3.4-5.6-8.6-27.2-30.3l-26-26.2 94-.3c101.8-.4 95.2 0 110.6-5.8 7.8-2.9 19.4-10.6 26.3-17.5 6.9-6.9 14.6-18.5 17.5-26.3 5.9-15.7 5.5-3.7 5.8-160.7.2-108.6 0-145.1-.9-148.3-1.7-6.1-8.7-13.6-14.6-15.6-5.2-1.8-11.2-1.9-16.1-.3z"/></svg>
    </div>
</x-wire-elements-pro::insert-item>
