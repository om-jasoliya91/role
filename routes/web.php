<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');
Route::post('/author/store', [AuthorController::class, 'store'])->name('author.store');
Route::get('/author/index', [AuthorController::class, 'index'])->name('authors.index');

