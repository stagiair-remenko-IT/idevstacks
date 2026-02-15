@props([
    'title' => null,
])

<div {{ $attributes->merge(['class' => 'glass-card overflow-hidden']) }}>
    @if($title)
        <div class="border-b border-white/10 bg-white/5 px-6 py-4">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">{{ $title }}</p>
        </div>
    @endif
    <div class="p-6 sm:p-8">
        {{ $slot }}
    </div>
</div>
