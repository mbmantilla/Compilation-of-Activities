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
        <div class="min-h-screen bg-gradient-to-br from-blue-400 to-indigo-600 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-300/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

            <div class="z-10 text-center mb-8">
                <a href="/" class="flex flex-col items-center gap-4 group transition-transform hover:scale-105">
                    <div class="text-6xl bg-white/20 backdrop-blur-md p-4 rounded-3xl border border-white/30 shadow-2xl">🌤</div>
                    <h1 class="text-3xl font-black text-white tracking-tight">WeatherSystem</h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/10 backdrop-blur-xl border border-white/20 shadow-2xl overflow-hidden sm:rounded-3xl z-10 mx-4">
                {{ $slot }}
            </div>
            
            <div class="z-10 mt-8">
                <a href="/" class="text-blue-100/70 hover:text-white transition-colors text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to home
                </a>
            </div>
        </div>
    </body>
</html>
