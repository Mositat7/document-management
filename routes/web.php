<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit'); // ⬅️ جدید
Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
Route::get('/documents/{document}/download/{attachment}', [DocumentController::class, 'download'])->name('documents.download');
Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');