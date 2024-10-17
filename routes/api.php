<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('authors/{author}/books', [AuthorController::class, 'books']);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('books', BookController::class);
