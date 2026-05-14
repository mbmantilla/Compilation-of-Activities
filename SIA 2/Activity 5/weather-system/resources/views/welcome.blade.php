<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'WeatherSystem') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="min-h-screen bg-gradient-to-br from-blue-400 to-indigo-600 flex flex-col items-center justify-center p-6 relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-300/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

            <!-- Navigation -->
            <header class="absolute top-0 left-0 right-0 p-8 flex justify-between items-center z-10">
                <div class="flex items-center gap-2 text-white">
                    <span class="text-3xl">🌤</span>
                    <span class="text-xl font-bold tracking-tight">WeatherSystem</span>
                </div>
                
                @if (Route::has('login'))
                    <nav class="flex gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2 rounded-full bg-white/20 hover:bg-white/30 text-white font-medium backdrop-blur-md border border-white/30 transition-all">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2 rounded-full text-white font-medium hover:bg-white/10 transition-all">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2 rounded-full bg-white text-indigo-600 font-bold shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <!-- Main Content -->
            <main class="max-w-4xl w-full text-center z-10">
                <div class="mb-8 inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-blue-100 backdrop-blur-sm animate-bounce">
                    <span class="flex h-2 w-2 rounded-full bg-blue-400"></span>
                    Live Weather Updates Now Available
                </div>

                <h1 class="text-6xl md:text-8xl font-black text-white mb-6 tracking-tight leading-none">
                    Weather for <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-100 to-indigo-200">Everyone.</span>
                </h1>

                <p class="text-xl text-blue-100 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Join our community to access real-time weather data, beautiful visualizations, and stay ahead of the elements.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="group relative px-8 py-4 bg-white text-indigo-600 font-bold rounded-2xl shadow-2xl hover:scale-105 transition-all w-full sm:w-auto overflow-hidden">
                            <span class="relative z-10">Go to Dashboard</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="group relative px-8 py-4 bg-white text-indigo-600 font-bold rounded-2xl shadow-2xl hover:scale-105 transition-all w-full sm:w-auto overflow-hidden">
                            <span class="relative z-10">Join for Free</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-indigo-700/30 text-white font-bold rounded-2xl border border-white/20 backdrop-blur-md hover:bg-indigo-700/40 transition-all w-full sm:w-auto">
                            Sign In
                        </a>
                    @endauth
                </div>

                <!-- Feature Grid Preview -->
                <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                    <div class="p-6 rounded-3xl bg-white/10 border border-white/20 backdrop-blur-md">
                        <div class="text-3xl mb-4">🌡️</div>
                        <h3 class="text-white font-bold text-lg mb-2">Real-time Data</h3>
                        <p class="text-blue-100/70 text-sm">Accurate temperature and conditions for any city worldwide.</p>
                    </div>
                    <div class="p-6 rounded-3xl bg-white/10 border border-white/20 backdrop-blur-md">
                        <div class="text-3xl mb-4">💨</div>
                        <h3 class="text-white font-bold text-lg mb-2">Wind Metrics</h3>
                        <p class="text-blue-100/70 text-sm">Detailed wind speed and direction data at your fingertips.</p>
                    </div>
                    <div class="p-6 rounded-3xl bg-white/10 border border-white/20 backdrop-blur-md">
                        <div class="text-3xl mb-4">👥</div>
                        <h3 class="text-white font-bold text-lg mb-2">Community</h3>
                        <p class="text-blue-100/70 text-sm">Join thousands of users tracking the weather together.</p>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="absolute bottom-0 left-0 right-0 p-8 text-center text-blue-200/50 text-sm">
                &copy; {{ date('Y') }} WeatherSystem. All rights reserved. Built with Laravel & Tailwind.
            </footer>
        </div>
    </body>
</html>
