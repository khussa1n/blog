<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

Route::redirect('/', '/articles');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show')->where('article', '[0-9]+');
Route::get('{slug}/articles', [ArticleController::class, 'index'])->where('slug', '[a-zA-Z0-9-]+');

Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::patch('/articles/{article}/archive', [ArticleController::class, 'archive'])->name('articles.archive');
    Route::patch('/articles/{article}/publish', [ArticleController::class, 'publish'])->name('articles.publish');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/posts', [AdminController::class, 'articlesIndex'])->name('admin.articles.index');
        Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
        Route::get('/roles', [AdminController::class, 'rolesIndex'])->name('admin.roles.index');
        Route::get('/permissions', [AdminController::class, 'permissionsIndex'])->name('admin.permissions.index');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/join', [UserController::class, 'join'])->name('join');
    Route::post('/join', [UserController::class, 'joinStore'])->name('join.store');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'loginStore'])->name('login.store');
});

Route::get('/users/{nickname}', [UserController::class, 'profile'])->name('profile');
