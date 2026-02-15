@props([
    'icon' => 'document',
    'iconColor' => 'indigo',
])

@php
    $iconClasses = match($iconColor) {
        'indigo' => 'bg-indigo-500/20 text-indigo-400 border-indigo-500/30',
        'amber' => 'bg-amber-500/20 text-amber-400 border-amber-500/30',
        'emerald' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
        'slate' => 'bg-slate-600/80 text-slate-300 border-slate-500/60',
        default => 'bg-indigo-500/20 text-indigo-400 border-indigo-500/30',
    };
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-4']) }}>
    <span class="flex h-12 w-12 shrink-0 items-center justify-center glass-icon {{ $iconClasses }}">
        <x-icon :name="$icon" class="h-6 w-6" />
    </span>
    <div class="min-w-0 flex-1">
        {{ $slot }}
    </div>
    @isset($actions)
        <div class="shrink-0">
            {{ $actions }}
        </div>
    @endisset
</div>
