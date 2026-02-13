<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Company::class);

        $companies = Company::withCount('documents')
            ->orderBy('name')
            ->get();

        return view('companies.index', [
            'companies' => $companies,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Company::class);

        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']).'-'.Str::random(6);
        }

        $company = Company::create($data);

        return redirect()
            ->route('companies.show', $company)
            ->with('status', __('Company created.'));
    }

    public function show(Company $company): View
    {
        $this->authorize('view', $company);

        $company->load([
            'documents' => fn ($q) => $q->with(['category', 'creator'])
                ->orderByDesc('is_pinned')
                ->orderByDesc('updated_at')
                ->limit(20),
        ]);

        return view('companies.show', [
            'company' => $company,
            'documents' => $company->documents,
        ]);
    }

    public function edit(Company $company): View
    {
        $this->authorize('update', $company);

        return view('companies.edit', [
            'company' => $company,
        ]);
    }

    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']).'-'.Str::random(6);
        }

        $company->update($data);

        return redirect()
            ->route('companies.show', $company)
            ->with('status', __('Company updated.'));
    }

    public function destroy(Company $company): RedirectResponse
    {
        $this->authorize('delete', $company);

        $company->delete();

        return redirect()
            ->route('companies.index')
            ->with('status', __('Company deleted.'));
    }
}
