<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Study Planner - Master Your Learning</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .gradient-text {
                background: linear-gradient(135deg, #818cf8 0%, #c084fc 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
    </head>
    <body class="bg-slate-950 text-slate-200 antialiased overflow-x-hidden">
        {{-- Hero Background --}}
        <div class="fixed inset-0 -z-10">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(79,70,229,0.1),transparent_50%)]"></div>
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-indigo-500/20 to-transparent"></div>
        </div>

        <div class="relative min-h-screen flex flex-col">
            {{-- Navigation --}}
            <nav class="container mx-auto px-6 py-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <span class="text-xl font-extrabold text-white tracking-tight">Study<span class="text-indigo-500">Planner</span></span>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl transition-all hover:scale-105 active:scale-95 shadow-lg shadow-indigo-500/20">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-slate-400 hover:text-white font-semibold transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-semibold rounded-xl transition-all border border-slate-700">Register</a>
                        @endif
                    @endauth
                </div>
            </nav>

            {{-- Main Hero --}}
            <main class="container mx-auto px-6 flex-1 flex flex-col items-center justify-center text-center py-20">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-sm font-bold mb-8 animate-bounce">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    v2.0 is now live
                </div>

                <h1 class="text-6xl md:text-8xl font-black text-white mb-8 tracking-tighter leading-[0.9]">
                    Master your <br>
                    <span class="gradient-text">Learning Journey</span>
                </h1>
                
                <p class="text-xl text-slate-400 max-w-2xl mb-12 leading-relaxed">
                    Organize your studies, track your progress, and achieve your academic goals with our beautiful, minimalist planner designed for modern students.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{ route('studies.index') }}" class="group relative px-10 py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-2xl transition-all hover:-translate-y-1 active:translate-y-0 shadow-2xl shadow-indigo-500/40 overflow-hidden">
                        <span class="relative z-10 flex items-center gap-2">
                            Get Started Free
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </span>
                    </a>
                    <a href="#features" class="px-10 py-5 bg-slate-900/50 hover:bg-slate-800 text-slate-300 font-bold rounded-2xl transition-all border border-slate-800">
                        Learn More
                    </a>
                </div>

                {{-- Feature Preview --}}
                <div class="mt-24 w-full max-w-5xl">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-[2.5rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                        <div class="relative bg-slate-900 border border-slate-800 rounded-[2rem] overflow-hidden shadow-2xl">
                            <div class="flex items-center gap-2 px-6 py-4 bg-slate-800/50 border-b border-slate-800">
                                <div class="flex gap-1.5">
                                    <div class="w-3 h-3 rounded-full bg-rose-500/20"></div>
                                    <div class="w-3 h-3 rounded-full bg-amber-500/20"></div>
                                    <div class="w-3 h-3 rounded-full bg-emerald-500/20"></div>
                                </div>
                                <div class="mx-auto text-xs font-bold text-slate-500 uppercase tracking-widest">Preview: Dashboard</div>
                            </div>
                            <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-6 opacity-50 grayscale group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                                <div class="h-32 bg-slate-800/50 rounded-2xl border border-slate-700/50"></div>
                                <div class="h-32 bg-slate-800/50 rounded-2xl border border-slate-700/50"></div>
                                <div class="h-32 bg-slate-800/50 rounded-2xl border border-slate-700/50"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            {{-- Footer --}}
            <footer class="container mx-auto px-6 py-12 text-center text-slate-500 text-sm border-t border-slate-900">
                <p>&copy; {{ date('Y') }} Study Planner. Built for students who care about their future.</p>
            </footer>
        </div>
    </body>
</html>
