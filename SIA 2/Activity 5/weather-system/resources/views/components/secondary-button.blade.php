<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white/10 border border-white/20 rounded-xl font-bold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-indigo-600 disabled:opacity-25 transition ease-in-out duration-150 backdrop-blur-sm']) }}>
    {{ $slot }}
</button>
