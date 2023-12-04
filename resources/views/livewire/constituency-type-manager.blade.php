<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Constituency Type Manager') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 dark:bg-gray-800 text-gray-900 dark:text-white">
    
        

        <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Constituency Type</button>

        <!-- Display a session message -->
        @if(session()->has('message'))
            <div class="bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Modal for Create and Edit -->
        @if($isModalOpen)
            @include('livewire.constituency-manager.create-constituency-type')
        @endif

        @include('livewire.constituency-manager.constituency-types-table', ['constituencyTypes' => $constituencyTypes])
    </div>

</x-app-layout>