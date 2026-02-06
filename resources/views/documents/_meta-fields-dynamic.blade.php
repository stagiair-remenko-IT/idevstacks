@props(['categories', 'document' => null])

@php
    /** @var \Illuminate\Support\Collection<int, \App\Models\Category> $categories */
    $meta = $document?->meta ?? [];
@endphp

<div class="border-t border-slate-600/50 pt-6 mt-6">
    <h3 class="flex items-center gap-2 text-sm font-semibold text-slate-300 mb-3">
        <x-icon name="key" class="h-4 w-4 text-indigo-400" />
        {{ __('Structured details') }}
    </h3>
    <p class="text-xs text-slate-500 mb-4" x-show="selectedCategoryId === ''" x-cloak>
        {{ __('Select a category above to show structured fields (e.g. IP, credentials) for this section.') }}
    </p>

    @foreach($categories as $category)
        @php
            $fields = $category->fields->sortBy('sort_order');
        @endphp
        @if($fields->isNotEmpty())
            <div x-show="selectedCategoryId === '{{ $category->id }}'"
                 x-cloak
                 x-transition
                 class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($fields as $field)
                    @php
                        $value = old('meta.'.$field->key, $meta[$field->key] ?? '');
                        $inputId = 'meta_'.$category->id.'_'.$field->key;
                        $fieldIcon = \App\Helpers\FieldIcon::forFieldKey($field->key);
                    @endphp
                    <div>
                        <label for="{{ $inputId }}" class="flex items-center gap-2 text-sm font-medium text-slate-400">
                            <x-icon :name="$fieldIcon" class="h-4 w-4 text-slate-500 shrink-0" />
                            {{ $field->label }}
                        </label>
                        @if($field->field_type === 'textarea')
                            <textarea id="{{ $inputId }}"
                                      name="meta[{{ $field->key }}]"
                                      class="mt-1 block w-full rounded-lg bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500"
                                      rows="3"
                                      x-bind:disabled="selectedCategoryId !== '{{ $category->id }}'">{{ $value }}</textarea>
                        @else
                            @php
                                $inputType = match($field->field_type) {
                                    'password' => 'password',
                                    'email' => 'email',
                                    'url' => 'url',
                                    'number' => 'number',
                                    default => 'text',
                                };
                            @endphp
                            <input type="{{ $inputType }}"
                                   id="{{ $inputId }}"
                                   name="meta[{{ $field->key }}]"
                                   value="{{ $value }}"
                                   class="mt-1 block w-full rounded-lg bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500"
                                   x-bind:disabled="selectedCategoryId !== '{{ $category->id }}'">
                        @endif
                        @if($field->help_text)
                            <p class="mt-1 text-xs text-slate-500">
                                {{ $field->help_text }}
                            </p>
                        @endif
                        <x-input-error :messages="$errors->get('meta.'.$field->key)" class="mt-1" />
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</div>
