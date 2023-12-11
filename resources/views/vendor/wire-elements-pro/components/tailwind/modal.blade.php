@props(['contentPadding' => true, 'onSubmit' => ''])
<form class="flex flex-col h-full" wire:submit.prevent="{{ $onSubmit }}">
    @if($title ?? false)
        <div class="p-4 sm:px-6 sm:py-5 border-b border-gray-150">
            <h3 class="text-lg leading-4 font-medium text-gray-800">{{ $title }}</h3>
        </div>
    @endif
    <div @class(['bg-white overflow-y-auto', 'px-4 pt-5 pb-4 sm:p-6 sm:pb-4' => $contentPadding])>
        {{ $slot }}
    </div>
    @if($buttons ?? false)
        <div class="bg-gray-50 px-4 py-3 sm:px-6 gap-x-2 space-y-2 sm:space-y-0 sm:flex sm:flex-row-reverse mt-auto">
            {{ $buttons }}
        </div>
    @endif
</form>
