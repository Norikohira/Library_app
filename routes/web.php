<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [AuthorController::class, 'index'])->name('index');

    # AUTHOR ROUTES
    Route::group(['prefix' => 'author', 'as' => 'author.'], function(){
        Route::get('/create', [AuthorController::class, 'create'])->name('create');
        Route::post('/store', [AuthorController::class, 'store'])->name('store');
        Route::get('/{id}/show', [AuthorController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AuthorController::class, 'edit'])->name('edit');
        Route::patch('/{id}/update', [AuthorController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [AuthorController::class, 'destroy'])->name('destroy');
    });

    # BOOK ROUTES
    Route::group(['prefix' => 'book', 'as' => 'book.'], function () {
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/store', [BookController::class, 'store'])->name('store');
        Route::get('/{id}/show', [BookController::class, 'show'])->name('show');
        Route::get('/{id}/preview', [BookController::class, 'preview'])->name('preview');
        Route::get('/{id}/edit', [BookController::class, 'edit'])->name('edit');
        Route::patch('/{id}/update', [BookController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [BookController::class, 'destroy'])->name('destroy');
    });
});