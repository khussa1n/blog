<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users/{nickname}', [UserController::class, 'profile'])->name('profile');
