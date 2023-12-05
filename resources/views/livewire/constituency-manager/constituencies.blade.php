<?php 

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

?>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Constituencies') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button wire:click="create()" data-toggle="modal" data-target="#create-constituency" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Constituency
            </button>
        </div>
    </div>
    
      <!-- Modal for Create and Edit -->
    @if($isModalOpen)
    <form wire:submit.prevent="store">
      <div id="create-constituency" title="Create Constituency" name="create-constituency" class="modal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="">Create Constituency</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      
                          <div class="mb-4">
                              <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                              <input wire:model="name" type="text" id="name" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                          </div>

                          <div class="mb-4">
                            <select wire:model="constituency_type">
                                <option value="">Select a constituency type</option>
                                @foreach ($constituencyTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="mb-4">
                            <select wire:model="nation">
                                <option value="">Select a nation</option>
                                @foreach ($nations as $nation)
                                    <option value="{{ $nation }}">{{ $nation }}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="mb-4">
                              <label for="population" class="block text-gray-700 text-sm font-bold mb-2">Population:</label>
                              <input wire:model="population" type="number" id="population" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="0">
                          </div>   

                          <div class="mb-4">
                              <label for="incumbent_party" class="block text-gray-700 text-sm font-bold mb-2">Incumbent Party:</label>
                              <input wire:model="incumbent_party" type="text" id="incumbent_party" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="Unknown">
                          </div>   
                          
                          
                      
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Constituency
                    </button>
                      <button type="button" wire:click="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                  </div>
              </div>    
          </div>
      </div>
    </form>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @include('livewire.constituency-manager.constituencies-table', ['constituencies' => $constituencies])
                </div>
            </div>
        </div>
    </div>

</div>
