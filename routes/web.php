<?php

use App\Http\Controllers\VeloraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VeloraAdminController;

Route::get('/login', fn () => response('Authentication is required.', 401))->name('login');

Route::get('/', [VeloraController::class, 'home'])->name('home');
Route::get('/properties', [VeloraController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [VeloraController::class, 'show'])->name('properties.show');
Route::post('/inquiries', [VeloraController::class, 'inquire'])->name('inquiries.store');

Route::middleware(['auth', 'velora.admin'])->prefix('admin/velora')->name('admin.velora.')->group(function () {
    Route::get('/', [VeloraAdminController::class, 'index'])->name('index');
    Route::post('/properties', [VeloraAdminController::class, 'store'])->name('properties.store');
    Route::put('/properties/{property}', [VeloraAdminController::class, 'update'])->name('properties.update');
    Route::post('/properties/{property}/archive', [VeloraAdminController::class, 'archive'])->name('properties.archive');
    Route::patch('/inquiries/{inquiry}', [VeloraAdminController::class, 'updateInquiry'])->name('inquiries.update');
});

