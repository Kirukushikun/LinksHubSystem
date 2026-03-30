<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HubController;
use App\Http\Controllers\AdminController;

// Public
Route::get('/', [HubController::class, 'index'])->name('hub');

// Admin login (outside middleware — needs to be accessible)
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin protected routes (inside middleware)
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/links', [AdminController::class, 'index'])->name('admin.index');

    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');
    Route::post('/categories/reorder', [AdminController::class, 'reorderCategories'])->name('admin.categories.reorder');

    Route::post('/links', [AdminController::class, 'storeLink'])->name('admin.links.store');
    Route::put('/links/{link}', [AdminController::class, 'updateLink'])->name('admin.links.update');
    Route::delete('/links/{link}', [AdminController::class, 'destroyLink'])->name('admin.links.destroy');
    Route::post('/links/reorder', [AdminController::class, 'reorderLinks'])->name('admin.links.reorder');
});