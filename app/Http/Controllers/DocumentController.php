<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentRevision;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Document::class);

        $query = Document::query()
            ->with(['category', 'creator'])
            ->orderByDesc('is_pinned')
            ->orderByDesc('updated_at');

        $search = $request->string('search')->toString();
        $categoryId = $request->integer('category_id') ?: null;
        $status = $request->string('status')->toString();

        if ($search !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%');
            });
        }

        if ($categoryId !== null) {
            $query->where('category_id', $categoryId);
        }

        if (in_array($status, ['draft', 'published'], true)) {
            $query->where('status', $status);
        }

        if (! $request->user()->isGlobalAdmin()) {
            $query->where(function ($q) use ($request): void {
                $q->where('status', 'published')
                    ->orWhere('created_by', $request->user()->id);
            });
        }

        return view('documents.index', [
            'documents' => $query->paginate(15)->withQueryString(),
            'categories' => Category::orderBy('name')->get(),
            'filters' => [
                'search' => $search,
                'category_id' => $categoryId,
                'status' => $status,
            ],
        ]);
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Document::class);

        $categories = Category::with('fields')->orderBy('name')->get();

        return view('documents.create', [
            'categories' => $categories,
        ]);
    }

    public function store(StoreDocumentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']).'-'.Str::random(6);
        }

        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $meta = $data['meta'] ?? [];
        unset($data['meta']);

        /** @var Document $document */
        $document = Document::create($data);
        $document->meta = $meta;
        $document->save();

        return redirect()
            ->route('documents.show', $document)
            ->with('status', 'Document created successfully.');
    }

    public function show(Document $document): View
    {
        $this->authorize('view', $document);

        $document->load(['category.fields', 'creator', 'updater']);

        return view('documents.show', [
            'document' => $document,
            'categoryFields' => $document->category?->fields ?? collect(),
        ]);
    }

    public function edit(Document $document): View
    {
        $this->authorize('update', $document);

        $categories = Category::with('fields')->orderBy('name')->get();
        $document->load('category.fields');

        return view('documents.edit', [
            'document' => $document,
            'categories' => $categories,
        ]);
    }

    public function update(UpdateDocumentRequest $request, Document $document): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = $document->slug ?: Str::slug($data['title']).'-'.Str::random(6);
        }

        $data['updated_by'] = $request->user()->id;

        $meta = $data['meta'] ?? [];
        unset($data['meta']);

        // store revision before updating
        DocumentRevision::create([
            'document_id' => $document->id,
            'edited_by' => $request->user()->id,
            'title' => $document->title,
            'content' => $document->content,
            'meta' => $document->meta,
        ]);

        $document->update($data);
        $document->meta = $meta;
        $document->save();

        return redirect()
            ->route('documents.show', $document)
            ->with('status', 'Document updated successfully.');
    }

    public function destroy(Request $request, Document $document): RedirectResponse
    {
        $this->authorize('delete', $document);

        $document->delete();

        return redirect()
            ->route('documents.index')
            ->with('status', 'Document deleted.');
    }
}

