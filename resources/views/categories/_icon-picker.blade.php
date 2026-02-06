@php
    $selected = old('icon', isset($category) ? ($category->icon ?? '') : '');
@endphp
<div>
    <x-input-label value="{{ __('Icon (optional)') }}" class="text-slate-400" />
    <p class="mt-0.5 text-xs text-slate-500 mb-3">
        {{ __('Choose an IT-related icon for this category. It appears in lists and on entries.') }}
    </p>
    <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 gap-2">
        @foreach(\App\Helpers\FieldIcon::categoryIconOptions() as $iconName => $label)
            <label class="relative flex flex-col items-center gap-1 p-2 rounded-lg border cursor-pointer transition-colors
                {{ ($selected === $iconName) ? 'border-indigo-500 bg-indigo-500/20 text-indigo-300' : 'border-slate-600 hover:border-slate-500 hover:bg-slate-700/50' }}">
                <input type="radio" name="icon" value="{{ $iconName }}"
                       class="sr-only peer"
                       {{ $selected === $iconName ? 'checked' : '' }}>
                <span class="flex items-center justify-center w-8 h-8 rounded-md bg-slate-700/80 border border-slate-600/50 text-slate-300">
                    <x-icon :name="$iconName" class="h-4 w-4" />
                </span>
                <span class="text-xs text-center leading-tight text-slate-400 truncate w-full max-w-[4.5rem]">{{ $label }}</span>
            </label>
        @endforeach
        <label class="relative flex flex-col items-center gap-1 p-2 rounded-lg border cursor-pointer transition-colors
            {{ ($selected === '' || $selected === null) ? 'border-indigo-500 bg-indigo-500/20 text-indigo-300' : 'border-slate-600 hover:border-slate-500 hover:bg-slate-700/50' }}">
            <input type="radio" name="icon" value=""
                   class="sr-only peer"
                   {{ $selected === '' || $selected === null ? 'checked' : '' }}>
            <span class="flex items-center justify-center w-8 h-8 rounded-md bg-slate-700/80 border border-slate-600/50 text-slate-500">
                <x-icon name="folder" class="h-4 w-4" />
            </span>
            <span class="text-xs text-center leading-tight text-slate-500 truncate w-full max-w-[4.5rem]">{{ __('Default') }}</span>
        </label>
    </div>
    <x-input-error :messages="$errors->get('icon')" class="mt-1" />
</div>
