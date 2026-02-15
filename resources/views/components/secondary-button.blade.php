<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 glass-button-ghost font-semibold text-xs text-slate-200 uppercase tracking-widest hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:ring-offset-2 focus:ring-offset-slate-900 disabled:opacity-25 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
