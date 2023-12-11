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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            
            <!-- Navigation -->
            @auth
                <livewire:layout.navigation />
            @endauth
            @guest
                <livewire:layout.guest-navigation />
            @endguest

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewire('insert-pro')
        @livewireScripts
        <script src="https://kit.fontawesome.com/f7ae14b249.js" crossorigin="anonymous"></script>
         <!-- Include the insert-component.js script -->
        <script src="{{ asset('vendor/wire-elements-pro/js/insert-component.js') }}"></script>
        @vite(['resources/js/app.js'])
    </body>
</html>
