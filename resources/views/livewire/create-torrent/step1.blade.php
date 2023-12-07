<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-md p-6 m-4 bg-white dark:bg-gray-800 rounded shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
            <span class="text-red-500 dark:text-red-400">Who</span> do we need to convince?
        </h1>
        <form wire:submit.prevent="$emit('incrementStep')" class="mt-4">
            <div class="mb-4">
                <label for="decisionMakers" class="block text-gray-700 dark:text-gray-300">Start typing to find decision makers</label>
                <input type="text" id="decisionMakers" wire:model="decisionMakers" required class="w-full px-4 py-2 mt-2 text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-gray-300 rounded-md focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                <p class="text-gray-500 dark:text-gray-300; text-sm py-2">Tip: You can type the name of a Member of Parliament, a Councillor, or an organisation.</p>
            </div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Next</button>
        </form>
    </div>
</div>