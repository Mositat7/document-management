<?php

use Illuminate\Support\Facades\Route;

Route::get('/documents', [DocumentController::class, 'index']);
Route::get('/documents/create', [DocumentController::class, 'create']);
Route::post('/documents', [DocumentController::class, 'store']);
Route::get('/documents/{document}', [DocumentController::class, 'show']);
Route::get('/documents/{document}/download/{attachment}', [DocumentController::class, 'download']);
Route::delete('/documents/{document}', [DocumentController::class, 'destroy']);
