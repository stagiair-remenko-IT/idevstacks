@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full glass-input text-white placeholder-slate-500 disabled:opacity-50']) }}>
