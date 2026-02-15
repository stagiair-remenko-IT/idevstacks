<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:ring-offset-2 focus:ring-offset-slate-900 transition ease-in-out duration-200 backdrop-blur-md bg-red-500/80 hover:bg-red-500 border border-red-400/30 shadow-lg shadow-red-900/20') }}>
    {{ $slot }}
</button>
