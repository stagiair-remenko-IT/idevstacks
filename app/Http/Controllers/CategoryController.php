<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\CategoryField;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Category::class);

        $categories = Category::with('fields')->orderBy('name')->get();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Category::class);

        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());

        return redirect()
            ->route('categories.edit', $category)
            ->with('status', 'Category created. You can now define custom fields.');
    }

    public function edit(Category $category): View
    {
        $this->authorize('update', $category);

        $category->load('fields');

        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()
            ->route('categories.edit', $category)
            ->with('status', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('status', 'Category deleted.');
    }

    public function storeField(Request $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);

        $data = $request->validate([
            'key' => ['required', 'string', 'max:255', 'alpha_dash'],
            'label' => ['required', 'string', 'max:255'],
            'field_type' => ['required', 'string', Rule::in(['text', 'textarea', 'password', 'email', 'url', 'number'])],
            'is_sensitive' => ['sometimes', 'boolean'],
            'is_required' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
            'help_text' => ['nullable', 'string'],
        ]);

        $data['is_sensitive'] = (bool) ($data['is_sensitive'] ?? false);
        $data['is_required'] = (bool) ($data['is_required'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $category->fields()->create($data);

        return redirect()
            ->route('categories.edit', $category)
            ->with('status', 'Field added.');
    }

    public function destroyField(Category $category, CategoryField $field): RedirectResponse
    {
        $this->authorize('update', $category);

        if ($field->category_id !== $category->id) {
            abort(404);
        }

        $field->delete();

        return redirect()
            ->route('categories.edit', $category)
            ->with('status', 'Field removed.');
    }
}

