<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Constituencies') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
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
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="max-w-12xl">
                        <div class="px-0">
                            <div class="max-w-12xl">
                                <input class="w-full bg-black bg-opacity-40 rounded" wire:model.debounce.150ms="searchTerm" wire:blur="$refresh" type="text" placeholder="Search constituencies...">
                            </div>
                        </div>
                    </div>
                    
                    <div class="">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @elseif (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($paginated_constituencies == null) 
                            <div class="alert alert-warning">
                                Constituencies data array is null.
                            </div>
                        @endif

                        @if ($paginated_constituencies != null) 
                             <!-- Constituencies Table -->
                        <table class="table-auto w-full mt-4 text-gray-900 dark:text-white">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Our ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ONS ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HoP ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a wire:click.prevent="sortBy('name')" role="button" href="#">
                                            Name
                                            @include('partials.sort-icon', ['field' => 'name'])
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nation</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Population</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Incumbent Party</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HoP Member ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paginated_constituencies as $constituency)
                                    <tr class="text-gray-900 dark:text-white">
                                        <td class="border px-4 py-2">{{ $constituency->id }}</td>
                                        <td class="border px-4 py-2">{{ $constituency->ons_id }}</td>
                                        <td class="border px-4 py-2">{{ $constituency->hop_id }}</td>
                                        <td class="border px-4 py-2">{{ $constituency->name }}</td>
                                        <td class="border px-4 py-2">{{ $constituency->constituency_type->name }}</td>
                                        <td class="border px-4 py-2">{{ $constituency->nation }}</td>
                                        <td class="border px-4 py-2">{{ $constituency->population }}</td>
                                        <td class="border px-4 py-2">{{ $constituency->incumbent_party }}</td>
                                        <td class="border px-4 py-2">{{ $constituency->hop_member_id }}</td>
                                        <td class="border px-4 py-2">
                                            <button wire:click="edit({{ $constituency->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                            <button wire:click="delete({{ $constituency->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(!empty($paginated_constituencies))
                            <div class="w-full py-6">
                                {{ $paginated_constituencies->links() }}
                            </div>
                        @endif

                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
