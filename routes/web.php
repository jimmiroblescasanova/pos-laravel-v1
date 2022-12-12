<?php

use App\Http\Controllers\AccessController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Settings\BusinessController;
use App\Http\Controllers\Settings\TicketController;

// routes for authenticating users
Route::get('login', [LoginController::class, 'ShowLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/accesos', AccessController::class)->name('access.index');
Route::get('/accesos/roles/{role:name}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::post('/accesos/roles/{role:name}/edit', [RoleController::class, 'update'])->name('roles.update');

Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
Route::get('/productos/nuevo', [ProductController::class, 'create'])->name('products.create');
Route::post('/productos/nuevo', [ProductController::class, 'store'])->name('products.store');
Route::get('/productos/{product}/editar', [ProductController::class, 'edit'])->name('products.edit');
Route::patch('/productos/{product}/editar', [ProductController::class, 'update'])->name('products.update');
Route::delete('/productos/{product}/editar', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/inventario', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventario', [InventoryController::class, 'update'])->name('inventory.update');

Route::get('/pos', [OrderController::class, 'create'])->name('orders.create');
Route::delete('/pos/{order}', [OrderController::class, 'delete'])->name('orders.delete');

Route::get('/ticket/{order}/pdf', [TicketController::class, 'printTicket'])->name('ticket.print');

Route::get('/configuraciones/empresa', [BusinessController::class, 'index'])->name('settings.business');
Route::get('/configuraciones/ticket', [TicketController::class, 'index'])->name('settings.ticket');
