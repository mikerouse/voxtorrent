<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts and Styles -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Include the insert-component.css stylesheet -->
        <link rel="stylesheet" href="{{ asset('vendor/wire-elements-pro/css/bootstrap-insert-component.css') }}">
        <!-- Scripts -->
  
        @vite(['resources/css/app.css'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased dark:bg-gray-800">
        <div class="min-h-screen bg-white dark:bg-gray-800">

            @can('do anything')
                <livewire:debugger.drawer />
            @endcan
           
            <div class="flex h-screen bg-white dark:bg-black" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">

                <!-- Sidebar -->
                <!-- Desktop Sidebar - Always visible on md screens and larger -->
                <div class="hidden md:block md:static md:overflow-y-auto md:flex-shrink-0 md:h-full md:w-64 dark:bg-slate-700 text-white overflow-y-auto">
                    <div class="h-full flex flex-col">
                        <!-- Sidebar content for desktop -->
                        <livewire:layout.sidebar />
                    </div>
                </div>

                <!-- Mobile Sidebar - Controlled by Alpine.js -->
                <div x-show="sidebarOpen" class="block md:hidden fixed inset-0 z-40 bg-gray-800 text-white overflow-y-auto transform transition-transform" :class="{ 'translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }" @click.away="sidebarOpen = false" @keydown.escape.window="sidebarOpen = false">
                    <div class="h-full flex flex-col py-6">
                        <!-- Your sidebar content for mobile -->
                        <livewire:layout.sidebar />
                    </div>
                </div>


                <div class="flex flex-col w-0 flex-1 overflow-hidden">
                    <!-- Mobile menu button -->
                    <div class="relative z-10 flex-shrink-0 flex h-16 bg-white dark:bg-gray-900 shadow md:hidden" id="mobile-menu-button">
                        <button @click.stop="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 md:hidden" aria-label="Open sidebar">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                
                    <main class="flex-1 relative overflow-y-auto focus:outline-none bg-transparent dark:bg-transparent">
                        <div class="">
                            {{ $slot }}
                        </div>
                    </main>

                </div>
            </div>

        </div>
        @livewire('insert-pro')
        @livewireScripts
        <script src="https://kit.fontawesome.com/f7ae14b249.js" crossorigin="anonymous"></script>
         <!-- Include the insert-component.js script -->
        <script src="{{ asset('vendor/wire-elements-pro/js/insert-component.js') }}"></script>
        @vite(['resources/js/app.js'])
    </body>
</html>
