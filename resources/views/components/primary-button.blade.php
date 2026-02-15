<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 glass-button text-sm font-semibold text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:ring-offset-2 focus:ring-offset-slate-900 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
