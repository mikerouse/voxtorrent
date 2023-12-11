@props(['contentPadding' => true, 'onSubmit' => null])
<form wire:submit.prevent="{{ $onSubmit }}">
    <div class="modal-header">
        @if($title ?? false)
            <h5 class="modal-title">{{ $title }}</h5>
        @endif
        <button type="button" class="btn-close" wire:click="$dispatch('modal.close')" aria-label="Close"></button>
    </div>
    <div @class(['modal-body' , 'px-0 py-0' => !$contentPadding])>
        {{ $slot }}
    </div>
    @if($buttons ?? false)
        <div class="modal-footer">
            {{ $buttons }}
        </div>
    @endif
</form>
