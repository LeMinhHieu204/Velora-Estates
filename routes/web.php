<?php

use App\Http\Controllers\VeloraController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VeloraController::class, 'home'])->name('home');
Route::get('/properties', [VeloraController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [VeloraController::class, 'show'])->name('properties.show');

