@php
    $weatherCondition = $weather['weather'][0]['main'] ?? 'Clear';
    $backgroundClass = match($weatherCondition) {
        'Clouds' => 'bg-gradient-to-br from-slate-400 to-blue-500',
        'Rain', 'Drizzle' => 'bg-gradient-to-br from-blue-700 to-slate-800',
        'Thunderstorm' => 'bg-gradient-to-br from-indigo-900 via-purple-900 to-slate-900',
        'Snow' => 'bg-gradient-to-br from-blue-100 to-indigo-300',
        'Clear' => 'bg-gradient-to-br from-blue-400 to-indigo-600',
        default => 'bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-600',
    };
@endphp

<x-app-layout :background="$backgroundClass">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto space-y-8">
            
            <!-- TOP NAV & SEARCH BAR -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/20 backdrop-blur-xl rounded-2xl border border-white/30 shadow-2xl">
                        <span class="text-4xl">
                            @php
                                $icon = match($weatherCondition) {
                                    'Clouds' => '☁️',
                                    'Rain', 'Drizzle' => '🌧️',
                                    'Thunderstorm' => '⛈️',
                                    'Snow' => '❄️',
                                    'Clear' => '☀️',
                                    default => '🌤️',
                                };
                            @endphp
                            {{ $icon }}
                        </span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-white tracking-tight">
                            {{ Auth::user()->role === 'admin' ? 'Admin Station' : 'Weather Hub' }}
                        </h1>
                        <p class="text-blue-100/80 font-medium">Monitoring conditions for <span class="text-white">{{ $weather['name'] ?? 'your location' }}</span></p>
                    </div>
                </div>
                
                <form method="GET" action="{{ route('dashboard') }}" class="relative group w-full lg:w-96">
                    <input 
                        type="text" 
                        name="city" 
                        value="{{ $city ?? '' }}"
                        placeholder="Explore another city..."
                        class="w-full pl-12 pr-4 py-4 rounded-2xl bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/40 focus:bg-white/20 transition-all duration-300 backdrop-blur-md shadow-inner"
                    >
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 group-focus-within:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="submit" class="hidden">Search</button>
                </form>
            </div>

            @if(session('error'))
                <div class="bg-red-500/20 backdrop-blur-xl p-4 rounded-2xl border border-red-500/30 text-white flex items-center gap-3 animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-bold">{{ session('error') }}</span>
                </div>
            @endif

            <!-- ADMIN SYSTEM OVERVIEW -->
            @if(Auth::user()->role === 'admin')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white/10 backdrop-blur-xl p-6 rounded-[2rem] border border-white/20 shadow-xl group hover:bg-white/20 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="p-4 bg-blue-500/20 rounded-2xl border border-blue-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-blue-100/60 uppercase tracking-widest">Total Users</p>
                                <p class="text-3xl font-black text-white">{{ $users->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-xl p-6 rounded-[2rem] border border-white/20 shadow-xl group hover:bg-white/20 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="p-4 bg-emerald-500/20 rounded-2xl border border-emerald-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.040L3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622l-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-blue-100/60 uppercase tracking-widest">Weather API</p>
                                <p class="text-xl font-black text-white">Active System</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-xl p-6 rounded-[2rem] border border-white/20 shadow-xl group hover:bg-white/20 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="p-4 bg-amber-500/20 rounded-2xl border border-amber-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-blue-100/60 uppercase tracking-widest">System Status</p>
                                <p class="text-xl font-black text-white">Operational</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- MAIN WEATHER DISPLAY -->
            @if(isset($weather['main']))
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                    <!-- HERO WEATHER CARD -->
                    <div class="xl:col-span-2 relative group overflow-hidden">
                        <div class="absolute inset-0 bg-white/5 backdrop-blur-sm rounded-[2.5rem] border border-white/20 -z-10"></div>
                        <div class="p-8 md:p-12 flex flex-col justify-between min-h-[450px]">
                            <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                                <div class="space-y-2">
                                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 border border-white/30 text-xs font-bold uppercase tracking-widest text-white backdrop-blur-md">
                                        <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Live Station
                                    </div>
                                    <h2 class="text-6xl md:text-8xl font-black text-white tracking-tighter">{{ $weather['name'] }}</h2>
                                    <p class="text-2xl text-blue-100 font-medium capitalize">{{ $weather['weather'][0]['description'] }}</p>
                                </div>
                                <div 
                                    x-data="{ 
                                        time: '',
                                        date: '',
                                        updateClock() {
                                            const now = new Date();
                                            this.time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                                            this.date = now.toLocaleDateString([], { weekday: 'long', day: '2-digit', month: 'short' });
                                        }
                                    }" 
                                    x-init="updateClock(); setInterval(() => updateClock(), 1000)"
                                    class="bg-white/10 backdrop-blur-xl p-6 rounded-3xl border border-white/20 text-right shadow-2xl min-w-[200px]"
                                >
                                    <p class="text-3xl font-black text-white tabular-nums" x-text="time"></p>
                                    <p class="text-blue-100 font-bold uppercase tracking-widest text-xs mt-1" x-text="date"></p>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row items-end justify-between mt-auto pt-12 gap-8">
                                <div class="flex items-center gap-4">
                                    <div class="text-[10rem] md:text-[12rem] font-black leading-none text-white tracking-tighter drop-shadow-2xl">
                                        {{ round($weather['main']['temp']) }}<span class="text-blue-200">°</span>
                                    </div>
                                    <div class="pb-6">
                                        <div class="text-2xl font-bold text-blue-100">Feels like {{ round($weather['main']['feels_like']) }}°</div>
                                        <div class="flex gap-4 mt-2">
                                            <span class="text-white/60 font-bold flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                </svg>
                                                {{ round($weather['main']['temp_max']) }}°
                                            </span>
                                            <span class="text-white/60 font-bold flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                                {{ round($weather['main']['temp_min']) }}°
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-0 bg-blue-400/30 blur-[80px] rounded-full animate-pulse"></div>
                                    <img src="https://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@4x.png" alt="weather icon" class="w-64 h-64 relative z-10 drop-shadow-2xl transform group-hover:scale-110 transition-transform duration-700">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- METRICS GRID -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-1 gap-6">
                        @php
                            $metrics = [
                                ['label' => 'Humidity', 'value' => ($weather['main']['humidity'] ?? 0) . '%', 'icon' => 'M19 14l-7 7m0 0l-7-7m7 7V3', 'color' => 'blue'],
                                ['label' => 'Wind Speed', 'value' => ($weather['wind']['speed'] ?? 0) . ' m/s', 'icon' => 'M14 5l7 7m0 0l-7 7m7-7H3', 'color' => 'indigo'],
                                ['label' => 'Pressure', 'value' => ($weather['main']['pressure'] ?? 0) . ' hPa', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707-.707', 'color' => 'purple'],
                                ['label' => 'Visibility', 'value' => (($weather['visibility'] ?? 0) / 1000) . ' km', 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z', 'color' => 'pink'],
                            ];
                        @endphp

                        @foreach($metrics as $metric)
                            <div class="bg-white/10 backdrop-blur-xl p-6 rounded-[2rem] border border-white/20 flex items-center justify-between group hover:bg-white/20 transition-all duration-300 shadow-xl">
                                <div class="flex items-center gap-4">
                                    <div class="p-4 bg-white/10 rounded-2xl border border-white/10 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $metric['icon'] }}" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-blue-100/60 uppercase tracking-widest">{{ $metric['label'] }}</p>
                                        <p class="text-2xl font-black text-white">{{ $metric['value'] }}</p>
                                    </div>
                                </div>
                                <div class="h-12 w-1 bg-white/10 rounded-full"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-pink-500/20 backdrop-blur-2xl p-12 rounded-[2.5rem] border border-pink-500/30 text-white text-center shadow-2xl">
                    <div class="text-6xl mb-4">📍</div>
                    <h2 class="text-3xl font-black mb-2">Location Not Found</h2>
                    <p class="text-pink-100 text-lg max-w-md mx-auto">The weather station couldn't locate "<span class="font-bold underline">{{ $city }}</span>". Please verify the city name.</p>
                </div>
            @endif

            <!-- ADMIN SECTION: USER MANAGEMENT -->
            @if(Auth::user()->role === 'admin')
                <div class="mt-12 space-y-6">
                    <div class="flex items-center justify-between px-2">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-amber-400/20 rounded-2xl border border-amber-400/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-3xl font-black text-white tracking-tight">System Community</h2>
                                <p class="text-blue-100/60 font-medium">Manage and monitor registered station operators</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-3xl rounded-[2.5rem] border border-white/10 shadow-2xl overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-white">
                                <thead>
                                    <tr class="bg-white/10 text-white font-black uppercase text-xs tracking-[0.2em]">
                                        <th class="px-8 py-6">Station Operator</th>
                                        <th class="px-8 py-6">Contact Endpoint</th>
                                        <th class="px-8 py-6">Access Level</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @foreach($users as $user)
                                        <tr class="hover:bg-white/5 transition-all duration-300 group">
                                            <td class="px-8 py-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="relative">
                                                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-400 to-indigo-600 flex items-center justify-center font-black text-white border-2 border-white/20 shadow-lg group-hover:rotate-6 transition-transform">
                                                            {{ substr($user->name, 0, 1) }}
                                                        </div>
                                                        @if($user->role === 'admin')
                                                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-amber-400 rounded-full border-2 border-indigo-900 shadow-sm"></div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="font-bold text-lg group-hover:text-blue-200 transition-colors">{{ $user->name }}</p>
                                                        <p class="text-xs font-bold text-white/30 uppercase tracking-widest">ID: #00{{ $user->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <span class="text-blue-100/70 font-medium">{{ $user->email }}</span>
                                            </td>
                                            <td class="px-8 py-6">
                                                @if($user->role === 'admin')
                                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl text-xs font-black bg-amber-400/10 text-amber-300 border border-amber-400/20 shadow-lg">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                                        ADMINISTRATOR
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl text-xs font-black bg-emerald-400/10 text-emerald-300 border border-emerald-400/20 shadow-lg">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                                        STANDARD OPERATOR
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- FOOTER SYSTEM INFO -->
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 border-t border-white/10 text-white/40 text-xs font-bold uppercase tracking-[0.2em]">
                <div class="flex items-center gap-4">
                    <p>Operator: <span class="text-white">{{ Auth::user()->name }}</span></p>
                    <span class="opacity-20">|</span>
                    <p>Access: <span class="{{ Auth::user()->role === 'admin' ? 'text-amber-400' : 'text-emerald-400' }}">{{ Auth::user()->role }}</span></p>
                </div>
                <p>&copy; 2024 WeatherSystem Digital Core</p>
            </div>

        </div>
    </div>
</x-app-layout>
