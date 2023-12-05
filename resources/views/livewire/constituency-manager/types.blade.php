<?php 

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

?>

<section>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Constituency Type Manager') }}
        </h2>
    </x-slot>

    <div class="container mx-auto my-4 px-4 text-gray-900 dark:text-white">
    
        <button wire:click="create()" data-toggle="modal" data-target="#create-constituency-type" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create Constituency Type
        </button>

        <!-- Display a session message -->
        @if(session()->has('message'))
            <div class="bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Modal for Create and Edit -->
        @if($isModalOpen)
            
            <div id="create-constituency-type" title="Create Constituency Type" name="create-constituency-type" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Create Constituency Type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="store">
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                                    <input wire:model="name" type="text" id="name" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                </div>
                        
                                <div class="mb-4">
                                    <label for="acronym" class="block text-gray-700 text-sm font-bold mb-2">Acronym:</label>
                                    <input wire:model="acronym" type="text" autocomplete="off" id="acronym" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Constituency Type</button>
                            <button type="button" wire:click="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                        </div>
                    </div>    
                </div>
            </div>

        @endif

        @include('livewire.constituency-manager.constituency-types-table', ['constituencyTypes' => $constituencyTypes])
    </div>
</section>