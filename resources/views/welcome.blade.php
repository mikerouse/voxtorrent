<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Voxtorrent</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
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
                        <h1 class="text-6xl text-white">voxtorrent</h1>
                        <p class="text-2xl text-white">
                            resonate, don't agitate
                        </p>
                    </div>
                </div>

                <div class="text-center">
                    <div class="">
                        <div class="text-gray-500 dark:text-gray-400">
                            <a href="https://github.com/sponsors/taylorotwell" class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                
                                

                                
                                sponsor us: created by former caseworkers, campaigners, and politicians; voxtorrent delivers change by resonation not agitation.
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