<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Study Planner</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased min-h-screen flex flex-col">

<nav class="border-b border-slate-800 bg-slate-900/50 backdrop-blur-xl sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl">📚</span>
                <a href="{{ url('/') }}" class="text-xl font-bold bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">
                    Study Planner
                </a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('studies.index') }}" class="text-sm font-medium hover:text-indigo-400 transition-colors">Dashboard</a>
                <a href="{{ route('studies.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-lg shadow-lg shadow-indigo-500/20 transition-all active:scale-95">
                    + New Task
                </a>
            </div>
        </div>
    </div>
</nav>

<main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        @yield('content')
    </div>
</main>

<footer class="border-t border-slate-800 bg-slate-900/50 py-8">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-slate-500 text-sm">
            📚 Study Planner System &copy; {{ date('Y') }} — Plan. Study. Achieve.
        </p>
    </div>
</footer>

</body>
</html>