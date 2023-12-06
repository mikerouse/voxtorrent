<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-md p-6 m-4 bg-white dark:bg-gray-800 rounded shadow-md text-gray-700 dark:text-white">
        <h1 class="text-2xl font-bold mb-4">What is the change you seek?</h1>
        <form wire:submit.prevent="submit">
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" id="name" wire:model="name" required class="w-full px-3 py-2 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Description</label>
                <textarea id="description" wire:model="description" rows="3" required class="w-full px-3 py-2 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline dark:bg-blue-900">
                Submit
            </button>
        </form>
    </div>
</div>