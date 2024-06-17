<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/articles');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show')->where('article', '[0-9]+');
Route::get('{slug}/articles', [ArticleController::class, 'index'])->name('category.articles.index')->where('slug', '[a-zA-Z0-9-]+');

Route::middleware('auth')->prefix('articles')->group(function () {
    Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::patch('/{article}/archive', [ArticleController::class, 'archive'])->name('articles.archive');
    Route::patch('/{article}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
});
