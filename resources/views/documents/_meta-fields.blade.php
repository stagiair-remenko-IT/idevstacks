@props(['category', 'document' => null])

@php
    /** @var \App\Models\Category|null $category */
    $fields = $category?->fields ?? collect();
    $meta = $document?->meta ?? [];
@endphp

@if($fields->isNotEmpty())
    <div class="border-t border-gray-200 pt-4 mt-4">
        <h3 class="text-sm font-semibold text-gray-700 mb-3">
            {{ __('Structured details') }}
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($fields->sortBy('sort_order') as $field)
                <div>
                    <x-input-label :for="$field->key" :value="$field->label" />

                    @php
                        $value = old('meta.'.$field->key, $meta[$field->key] ?? '');
                    @endphp

                    @if($field->field_type === 'textarea')
                        <textarea id="{{ $field->key }}"
                                  name="meta[{{ $field->key }}]"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  rows="3">{{ $value }}</textarea>
                    @else
                        <x-text-input id="{{ $field->key }}"
                                      name="meta[{{ $field->key }}]"
                                      type="{{ $field->field_type === 'password' ? 'password' : 'text' }}"
                                      class="mt-1 block w-full"
                                      :value="$value" />
                    @endif

                    @if($field->help_text)
                        <p class="mt-1 text-xs text-gray-500">
                            {{ $field->help_text }}
                        </p>
                    @endif

                    <x-input-error :messages="$errors->get('meta.'.$field->key)" class="mt-1" />
                </div>
            @endforeach
        </div>
    </div>
@endif

