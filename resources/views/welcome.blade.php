<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Voxtorrent</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: solid/exclamation -->
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 12a1 1 0 11-2 0 1 1 0 012 0zm-1-10a1 1 0 00-.867.5l-4 8a1 1 0 00.73 1.5h8a1 1 0 00.867-1.5l-4-8A1 1 0 0010 4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        This is an alpha system and is still under development. <a href="https://github.com/mikerouse/voxtorrent/discussions">Please report any issues you encounter</a>.
                    </p>
                </div>
            </div>
        </div>

        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">


            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <div class="flex justify-center">
                        <div class="w-32 h-32">
                            @include('svg.logo')
                        </div>
                    </div>
                </div>

                <div class="mt-16 mb-16">
                    <div class="text-center">
                        <h1 class="text-6xl text-gray-900 dark:text-gray-100">
                            voxtorrent
                        </h1>
                        <p class="text-2xl text-gray-900 dark:text-gray-100">
                            resonate, don't agitate
                        </p>
                    </div>
                </div>

                <div class="mt-16 mb-16">
                    <div class="text-center">
                        <a href="/create" class="inline-flex items-center mx-2 justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-500 hover:bg-red-600">
                            <i class="fas fa-plus-circle mr-2"></i> create
                        </a>
                        <a href="/latest" class="inline-flex items-center justify-center mx-2 px-5 py-3 border border-transparent text-base font-medium rounded-md text-red-500 bg-white hover:bg-gray-50">
                            <i class="fas fa-newspaper mr-2"></i> latest
                        </a>
                    </div>
                </div>

                <div class="text-center">
                    <div class="">
                        <div class="text-gray-500 dark:text-gray-400">
                            <a href="https://github.com/sponsors/mikerouse" class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                sponsor us: built by (and in collaboration with) caseworkers, campaigners, and politicians
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="ms-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:ms-0">
                        <div class="mt-8 space-x-4">
                            <a href="/privacy" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">Privacy</a>
                            <a href="/terms" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">Terms</a>
                            <a href="/cookies" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">Cookies</a>
                            <a href="/contact" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">Contact</a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="ms-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:ms-0">
                        <div class="justify-center mt-8 text-sm text-gray-500 dark:text-gray-400">
                            &copy; 2023 Bluetorch Consulting Ltd. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>