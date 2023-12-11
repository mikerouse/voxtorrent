@props(['closeButton' => true, 'onSubmit' => null, 'contentPadding' => true])
<form wire:submit.prevent="{{ $onSubmit }}">
    <div class="offcanvas-header">
        @if($title ?? false)
        <h5 class="offcanvas-title">{{ $title }}</h5>
        @endif
        @if($closeButton)
        <button type="button" wire:click="$dispatch('slide-over.close')" class="btn-close text-reset" aria-label="Close"></button>
        @endif
    </div>
    <div @class(['offcanvas-body', 'px-0 py-0' => !$contentPadding])>
        {{ $slot }}
    </div>
    @if($buttons ?? false)
        <div class="offcanvas-body py-0">
            {{ $buttons }}
        </div>
    @endif
</form>
