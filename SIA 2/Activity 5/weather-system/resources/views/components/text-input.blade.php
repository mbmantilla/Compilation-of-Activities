@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/10 border border-white/20 text-white placeholder-white/50 focus:border-white/50 focus:ring-white/50 rounded-xl shadow-sm backdrop-blur-sm transition-all']) }}>
