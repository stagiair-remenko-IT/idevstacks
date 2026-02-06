@props([
    'name',
    'class' => '',
    'size' => 'md',
])

@php
    $sizeClasses = match($size) {
        'sm' => 'h-4 w-4',
        'lg' => 'h-6 w-6',
        default => 'h-5 w-5',
    };
    $classes = trim($sizeClasses . ' ' . ($class ?? ''));

    // Map our icon names to Heroicons (outline set) from blade-heroicons package
    $heroiconMap = [
        'dashboard' => 'heroicon-o-squares-2x2',
        'document' => 'heroicon-o-document-text',
        'document-text' => 'heroicon-o-document-text',
        'folder' => 'heroicon-o-folder',
        'users' => 'heroicon-o-users',
        'category' => 'heroicon-o-tag',
        'chevron-right' => 'heroicon-o-chevron-right',
        'arrow-left' => 'heroicon-o-arrow-left',
        'pencil' => 'heroicon-o-pencil',
        'trash' => 'heroicon-o-trash',
        'plus' => 'heroicon-o-plus',
        'search' => 'heroicon-o-magnifying-glass',
        'filter' => 'heroicon-o-funnel',
        'pin' => 'heroicon-o-bookmark',
        'printer' => 'heroicon-o-printer',
        'server' => 'heroicon-o-server-stack',
        'laptop' => 'heroicon-o-computer-desktop',
        'remote' => 'heroicon-o-computer-desktop',
        'network' => 'heroicon-o-signal',
        'lock' => 'heroicon-o-lock-closed',
        'map-pin' => 'heroicon-o-map-pin',
        'terminal' => 'heroicon-o-command-line',
        'key' => 'heroicon-o-key',
        'user' => 'heroicon-o-user',
        'clock' => 'heroicon-o-clock',
        'check' => 'heroicon-o-check',
        'cog' => 'heroicon-o-cog-6-tooth',
        'globe' => 'heroicon-o-globe-alt',
        'link' => 'heroicon-o-link',
        'shopping-bag' => 'heroicon-o-shopping-bag',
        'shopping-cart' => 'heroicon-o-shopping-cart',
        'credit-card' => 'heroicon-o-credit-card',
        'cloud' => 'heroicon-o-cloud',
        'building' => 'heroicon-o-building-office-2',
        'briefcase' => 'heroicon-o-briefcase',
        'chart-bar' => 'heroicon-o-chart-bar',
        'presentation-chart' => 'heroicon-o-presentation-chart-bar',
        'window' => 'heroicon-o-window',
    ];
    $heroiconName = $heroiconMap[$name] ?? 'heroicon-o-document-text';
    $attrs = $attributes->merge(['class' => $classes])->getIterator()->getArrayCopy();
    $iconClass = $attrs['class'] ?? '';
    unset($attrs['class']);
@endphp

{!! svg($heroiconName, $iconClass, $attrs)->toHtml() !!}
