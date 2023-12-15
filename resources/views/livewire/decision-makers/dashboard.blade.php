<div class="flex flex-col space-y-4 mt-7 dark:bg-gray-800">
    <div class="flex items-center justify-center bg-gray-100 dark:bg-gray-800" id="chooseWhat">
        <div class="w-full max-w-xl bg-white dark:bg-gray-800 rounded shadow-md">
            <div class="px-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    <span class="text-red-500 dark:text-red-500">decision</span> makers
                </h1>
            </div>
            <div class="px-6 space-y-4 mt-4">
                <div>
                    <h2 class="text-xl font-semibold dark:text-gray-300">
                       the crown
                    </h2>
                    <div class="pl-4">
                        <a href="{{ route('decision-makers/hoc-members') }}" class="block py-4 dark:text-white" wire:navigate>
                            <i class="fas fa-house-user mr-1"></i>
                            {{ __('hm the king') }}
                        </a>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-semibold dark:text-gray-300">
                       government of the united kingdom
                    </h2>
                    <div class="pl-4">
                        <a href="{{ route('decision-makers/hoc-members') }}" class="block py-4 dark:text-white" wire:navigate>
                            <i class="fas fa-house-user mr-1"></i>
                            {{ __('the prime minister and cabinet') }}
                        </a>
                    </div>
                    <div class="pl-4">
                        <a href="{{ route('decision-makers/hoc-members') }}" class="block py-4 dark:text-white" wire:navigate>
                            <i class="fas fa-house-user mr-1"></i>
                            {{ __('government departments') }}
                        </a>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-semibold dark:text-gray-300">
                       national legislative chambers
                    </h2>
                    <div class="pl-4">
                        <a href="{{ route('decision-makers/hoc-members') }}" class="block py-4 dark:text-white" wire:navigate>
                            <i class="fas fa-house-user mr-1"></i>
                            {{ __('house of commons') }}
                        </a>
                    </div>
                    <div class="pl-4">
                        <a href="{{ route('decision-makers/hoc-members') }}" class="block py-4 dark:text-white" wire:navigate>
                            <i class="fas fa-house-user mr-1"></i>
                            {{ __('house of lords') }}
                        </a>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-semibold dark:text-gray-300">
                      devolved governing bodies
                    </h2>
                    <div class="pl-4 space-y-1">
                        <a href="{{ route('decision-makers/hoc-members') }}" class="block py-4 dark:text-white" wire:navigate>
                            <i class="fas fa-house-user mr-1"></i>
                            {{ __('scottish parliament') }}
                        </a>
                        <a href="{{ route('decision-makers/hoc-members') }}" class="block py-4 dark:text-white" wire:navigate>
                            <i class="fas fa-house-user mr-1"></i>
                            {{ __('welsh assembly') }}
                        </a>
                        <a href="{{ route('decision-makers/hoc-members') }}" class="block py-4 dark:text-white" wire:navigate>
                            <i class="fas fa-house-user mr-1"></i>
                            {{ __('northern ireland assembly') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>