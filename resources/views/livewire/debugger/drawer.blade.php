<div x-data="{ open: false }" @keydown.window.f1.prevent="open = !open" 
    class="fixed bottom-0 right-0 m-4 bg-white dark:bg-gray-900 p-4 rounded-lg shadow-lg z-50 overflow-auto max-h-96 max-w-3xl border-zinc-300 border" style="width: 800px" x-show="open">
    <div class="bg-white dark:bg-gray-800 p-4 flex justify-between items-center">
        <h2 class="font-bold text-lg mb-2">
            Debugger
        </h2>
        <button @click="open = false" class="px-2 py-2 bg-red-500 text-white rounded text-xs">Close</button>
    </div>
    <div>
        @if(!empty($debug))
            <div class="overflow-auto text-xs">
                <pre class="overflow-x-auto whitespace-pre-wrap">
                    $debug: {{ print_r($debug, true) }}
                </pre>
            </div>
        @else
            <p class="text-gray-500">No $debug info available.</p>
        @endif
    </div>
    <button @click="open = false" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">Close</button>
</div>