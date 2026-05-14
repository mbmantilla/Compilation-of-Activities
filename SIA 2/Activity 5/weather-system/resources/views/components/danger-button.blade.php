<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-pink-600/80 border border-pink-500/50 rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-pink-600 active:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 focus:ring-offset-indigo-600 transition ease-in-out duration-150 shadow-lg backdrop-blur-sm']) }}>
    {{ $slot }}
</button>
