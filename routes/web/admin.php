<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/posts', [AdminController::class, 'articlesIndex'])->name('admin.articles.index');
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    Route::get('/roles', [AdminController::class, 'rolesIndex'])->name('admin.roles.index');
    Route::get('/permissions', [AdminController::class, 'permissionsIndex'])->name('admin.permissions.index');
});
