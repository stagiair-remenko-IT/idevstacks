<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Document;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $companiesCount = Company::count();
        $documentsCount = Document::count();
        $publishedCount = Document::where('status', 'published')->count();
        $draftCount = Document::where('status', 'draft')->count();
        $pinnedCount = Document::where('is_pinned', true)->count();

        $recentDocuments = Document::query()
            ->with(['company', 'category', 'creator'])
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get();

        return view('dashboard', [
            'companiesCount' => $companiesCount,
            'documentsCount' => $documentsCount,
            'publishedCount' => $publishedCount,
            'draftCount' => $draftCount,
            'pinnedCount' => $pinnedCount,
            'recentDocuments' => $recentDocuments,
        ]);
    }
}
