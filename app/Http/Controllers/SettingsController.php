<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $prefs = $user->preferences ?? [];

        return view('settings.index', [
            'version' => config('app.version'),
            'itemsPerPage' => $prefs[User::PREF_ITEMS_PER_PAGE] ?? 15,
            'recentCount' => $prefs[User::PREF_RECENT_COUNT] ?? 10,
            'compactMode' => (bool) ($prefs[User::PREF_COMPACT_MODE] ?? false),
            'sidebarCounts' => (bool) ($prefs[User::PREF_SIDEBAR_COUNTS] ?? true),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'items_per_page' => ['required', 'integer', 'in:15,25,50,100'],
            'recent_count' => ['required', 'integer', 'in:5,10,15,20'],
            'compact_mode' => ['boolean'],
            'sidebar_counts' => ['boolean'],
        ]);

        $user = $request->user();
        $user->setPreference(User::PREF_ITEMS_PER_PAGE, (int) $validated['items_per_page']);
        $user->setPreference(User::PREF_RECENT_COUNT, (int) $validated['recent_count']);
        $user->setPreference(User::PREF_COMPACT_MODE, $request->boolean('compact_mode'));
        $user->setPreference(User::PREF_SIDEBAR_COUNTS, $request->boolean('sidebar_counts'));

        return redirect()->route('settings.index')
            ->with('status', __('Settings saved.'));
    }
}
