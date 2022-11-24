<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;

// routes for authenticating users
Route::get('login', [LoginController::class, 'ShowLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');

Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
Route::get('/productos/nuevo', [ProductController::class, 'create'])->name('products.create');
Route::post('/productos/nuevo', [ProductController::class, 'store'])->name('products.store');