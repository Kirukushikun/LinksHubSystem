<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use App\Http\Controllers\HubController;
use App\Http\Controllers\AdminController;

// ── Rate Limiters ──────────────────────────────
// Max 5 login attempts per minute per IP
RateLimiter::for('admin-login', function () {
    return Limit::perMinute(5)->by(request()->ip());
});

// Public hub — 60 requests per minute per IP (basic DoS guard)
RateLimiter::for('hub', function () {
    return Limit::perMinute(60)->by(request()->ip());
});

// ── Public ─────────────────────────────────────
Route::get('/', [HubController::class, 'index'])
    ->name('hub')
    ->middleware('throttle:hub');

// ── Admin Auth (unprotected) ───────────────────
Route::get('/admin/login', [AdminController::class, 'loginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AdminController::class, 'login'])
    ->name('admin.login.post')
    ->middleware('throttle:admin-login');

Route::post('/admin/logout', [AdminController::class, 'logout'])
    ->name('admin.logout');

// ── Admin Protected ────────────────────────────
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/links', [AdminController::class, 'index'])->name('admin.index');

    // Categories — reorder BEFORE {category} wildcard
    Route::post('/categories/reorder', [AdminController::class, 'reorderCategories'])->name('admin.categories.reorder');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

    // Links — reorder BEFORE {link} wildcard
    Route::post('/links/reorder', [AdminController::class, 'reorderLinks'])->name('admin.links.reorder');
    Route::post('/links', [AdminController::class, 'storeLink'])->name('admin.links.store');
    Route::put('/links/{link}', [AdminController::class, 'updateLink'])->name('admin.links.update');
    Route::delete('/links/{link}', [AdminController::class, 'destroyLink'])->name('admin.links.destroy');
});