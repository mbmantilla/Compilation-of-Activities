<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'WeatherSystem') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-white selection:bg-white selection:text-indigo-600">
        <div class="min-h-screen {{ $background ?? 'bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-600' }} relative overflow-hidden transition-all duration-1000">
            <!-- Decorative background elements -->
            <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] bg-white/10 rounded-full blur-3xl animate-pulse z-0 pointer-events-none"></div>
            <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-300/10 rounded-full blur-3xl animate-pulse z-0 pointer-events-none" style="animation-delay: 2s;"></div>

            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/10 backdrop-blur-md border-b border-white/20 relative z-10">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="relative z-10">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
