<?php

// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtaController;

Route::get('/', [UtaController::class, 'index'])->name('home');
Route::post('/calculate', [UtaController::class, 'calculate'])->name('calculate');
Route::get('/history', [UtaController::class, 'history'])->name('history');
Route::post('/delete-history/{id}', [UtaController::class, 'deleteHistory'])->name('delete.history');
Route::post('/recalculate-history/{id}', [UtaController::class, 'recalculateHistory'])->name('recalculate.history');

