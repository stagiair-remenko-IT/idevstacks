<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var Document $document */
        $document = $this->route('document');

        return $this->user()?->can('update', $document) ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var Document $document */
        $document = $this->route('document');

        return [
            'company_id' => ['nullable', 'exists:companies,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('documents', 'slug')->ignore($document->id),
            ],
            'content' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'is_pinned' => ['sometimes', 'boolean'],
        ] + $this->dynamicFieldRules();
    }

    /**
     * @return array<string, mixed>
     */
    protected function dynamicFieldRules(): array
    {
        $rules = [];

        $categoryId = $this->input('category_id');

        if (! $categoryId) {
            return $rules;
        }

        /** @var Category|null $category */
        $category = Category::query()->with('fields')->find($categoryId);

        if (! $category) {
            return $rules;
        }

        foreach ($category->fields as $field) {
            $fieldRules = ['nullable', 'string'];

            if ($field->is_required) {
                $fieldRules[] = 'required';
            }

            $rules['meta.'.$field->key] = $fieldRules;
        }

        return $rules;
    }
}

