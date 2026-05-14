<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-white border border-transparent rounded-xl font-bold text-sm text-indigo-600 uppercase tracking-widest hover:bg-blue-50 focus:bg-blue-50 active:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600 transition ease-in-out duration-150 shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all']) }}>
    {{ $slot }}
</button>
