@props([
    'title' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-slate-700/80 bg-slate-800/80 shadow-xl overflow-hidden']) }}>
    @if($title)
        <div class="border-b border-slate-700/80 bg-slate-800/50 px-6 py-4">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">{{ $title }}</p>
        </div>
    @endif
    <div class="p-6 sm:p-8">
        {{ $slot }}
    </div>
</div>
