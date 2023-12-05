<div class="container">
    <!-- Constituencies Table -->
    <table class="table-auto w-full mt-4 text-gray-900 dark:text-white">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nation</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Population</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Incumbent Party</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($constituencies as $constituency)
                <tr class="text-gray-900 dark:text-white">
                    <td class="border px-4 py-2">{{ $constituency->id }}</td>
                    <td class="border px-4 py-2">{{ $constituency->name }}</td>
                    <td class="border px-4 py-2">{{ $constituency->constituency_type->name }}</td>
                    <td class="border px-4 py-2">{{ $constituency->nation }}</td>
                    <td class="border px-4 py-2">{{ $constituency->population }}</td>
                    <td class="border px-4 py-2">{{ $constituency->incumbent_party }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $constituency->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                        <button wire:click="delete({{ $constituency->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>