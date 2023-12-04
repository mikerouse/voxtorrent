<div class="container mx-auto px-4 dark:bg-gray-800 text-gray-900 dark:text-white">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Constituency Manager') }}
    </h2>
     <!-- Modal for Create and Edit -->
    @if($isModalOpen)
        @include('livewire.constituency-manager.create-constituency-type')
    @endif

    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Constituency Type</button>

    <!-- Display a session message -->
    @if(session()->has('message'))
        <div class="bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Constituency Types Table -->
    <table class="table-auto w-full mt-4 text-gray-900 dark:text-white">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acronym</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($constituencyTypes as $constituencyType)
                <tr class="text-gray-900 dark:text-white">
                    <td class="border px-4 py-2">{{ $constituencyType->name }}</td>
                    <td class="border px-4 py-2">{{ $constituencyType->acronym }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $constituencyType->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                        <button wire:click="delete({{ $constituencyType->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
