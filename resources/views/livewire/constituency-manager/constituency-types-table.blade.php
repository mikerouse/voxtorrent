<div>
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