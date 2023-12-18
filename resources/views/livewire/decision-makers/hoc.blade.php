<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Members of the House of Commons (UK Parliament)') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($this->hoc_members !== null && count($this->hoc_members) > 0)
        <div class="container mx-auto px-4 my-6">
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($hoc_members as $member)
                    <li class="border p-4 rounded shadow">
                        @if ($member->thumbnail_url)
                            <img src="{{ $member->thumbnail_url }}" alt="{{ $member->display_name }}" class="thumbnail-image w-full h-64 object-cover mb-4">
                        @endif
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 leading-tight">{{ $member->display_name }}</h3>
                        <div class="flex items-center">
                            <div class="h-4 w-4 rounded-full 
                                {{ $member->current_party == 'Conservative' ? 'bg-blue-500' : 
                                    ($member->current_party == 'Labour' ? 'bg-red-500' : 
                                    ($member->current_party == 'Labour (Co-op)' ? 'bg-red-500' : 
                                    ($member->current_party == 'Scottish National Party' ? 'bg-orange-500' : 
                                    ($member->current_party == 'Liberal Democrat' ? 'bg-yellow-500' : 'bg-white')))) }}">
                            </div>
                            <h4 class="ml-2 text-gray-800 dark:text-gray-200 leading-tight">{{ $member->current_party }}</h4>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-full py-6 flex justify-center">
            {{ $hoc_members->links() }}
        </div>
    @else
        <div class="m-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 flex items-start" role="alert">
            <div class="text-lg pr-2">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
                <p class="font-bold">Warning</p>
                <p>No Members have been found.</p>
                <p>Please run the process and try again.</p>
            </div>
        </div>
    @endif
</div>

