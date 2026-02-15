<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('companies', CompanyController::class);
    Route::resource('documents', DocumentController::class);

    Route::middleware(['role:global_admin'])->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::post('categories/{category}/fields', [CategoryController::class, 'storeField'])
            ->name('categories.fields.store');
        Route::delete('categories/{category}/fields/{field}', [CategoryController::class, 'destroyField'])
            ->name('categories.fields.destroy');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('users', AdminUserController::class)->except(['show']);
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
