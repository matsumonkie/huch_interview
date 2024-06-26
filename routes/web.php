<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserSearchController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Search
Route::get('/search-users', [UserSearchController::class, 'showSearchForm'])->name('search-users.form');
Route::post('/search-users', [UserSearchController::class, 'searchUsers'])->name('search-users');
