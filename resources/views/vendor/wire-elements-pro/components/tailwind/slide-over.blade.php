@props(['closeButton' => true, 'onSubmit' => null, 'contentPadding' => true])
<form class="flex h-full flex-col" wire:submit.prevent="{{ $onSubmit }}">
    <div class="px-4 sm:px-6">
        <div class="flex items-start justify-between">
            @if($title ?? false)
            <h2 class="text-lg font-medium text-gray-900">{{ $title }}</h2>
            @endif
            @if($closeButton)
            <div class="ml-3 flex h-7 items-center">
                <button type="button"
                        class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        wire:click="$dispatch('slide-over.close')">
                    <span class="sr-only">Close panel</span>
                    <svg class="h-6 w-6"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            @endif
        </div>
    </div>
    <div @class(['relative mt-6 flex-1', 'px-4 sm:px-6' => $contentPadding])>
        <div @class(['absolute inset-0', 'px-4 sm:px-6' => $contentPadding])>
            {{ $slot }}

            @if($buttons ?? false)
                <div @class(['mt-6', 'px-4 sm:px-6' => !$contentPadding])>
                    {{ $buttons }}
                </div>
            @endif
        </div>
    </div>
</form>
