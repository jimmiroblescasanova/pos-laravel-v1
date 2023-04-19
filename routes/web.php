<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Reports\DailySalesController;
use App\Http\Controllers\Reports\InventoryCountController;
use App\Http\Controllers\Reports\ProductSalesController;
use App\Http\Controllers\Settings\TicketController;
use App\Http\Controllers\Settings\BusinessController;

// routes for authenticating users
Route::get('login', [LoginController::class, 'ShowLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/notificacion/{id}', [HomeController::class, 'readNotification'])->name('home.readNotification');
Route::get('/leer-notificaciones', [HomeController::class, 'readAllNotifications'])->name('home.readAllNotifications');

Route::group([
    'prefix' => '/accesos',
    'as' => 'access.',
], function () {
    Route::get('/', AccessController::class)->name('index');
    Route::get('/roles/nuevo', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/nuevo', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role:name}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{role:name}/edit', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role:name}/edit', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('/usuarios/nuevo', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios/nuevo', [UserController::class, 'store'])->name('users.store');
    Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/usuarios/{user}/editar', [UserController::class, 'update'])->name('users.update');
    Route::delete('/usuarios/{user}/editar', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
Route::get('/productos/nuevo', [ProductController::class, 'create'])->name('products.create');
Route::post('/productos/nuevo', [ProductController::class, 'store'])->name('products.store');
Route::post('/productos/descargar', [ProductController::class, 'download'])->name('products.download');
Route::get('/productos/importar', [ProductController::class, 'import'])->name('products.import');
Route::post('/productos/importar', [ProductController::class, 'handleImport'])->name('products.handleImport');
Route::get('/productos/{product}/editar', [ProductController::class, 'edit'])->name('products.edit');
Route::patch('/productos/{product}/editar', [ProductController::class, 'update'])->name('products.update');
Route::delete('/productos/{product}/editar', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/inventario', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventario', [InventoryController::class, 'update'])->name('inventory.update');
Route::post('/inventario/exportar', [InventoryController::class, 'export'])->name('inventory.export');
Route::get('/inventario/importar', [InventoryController::class, 'import'])->name('inventory.import');
Route::post('/inventario/importar', [InventoryController::class, 'handleImport'])->name('inventory.handleImport');

Route::get('/pos', [OrderController::class, 'create'])->name('orders.create');
Route::delete('/pos/{order}', [OrderController::class, 'delete'])->name('orders.delete');

Route::get('/pos/{order}/pdf', [OrderController::class, 'printTicket'])->name('ticket.print');

Route::get('/configuraciones/empresa', BusinessController::class)->name('settings.business');
Route::get('/configuraciones/ticket', TicketController::class)->name('settings.ticket');

Route::get('/ventas', [SaleController::class, 'index'])->name('sales.index');
Route::get('/ventas/{order}/ver', [SaleController::class, 'show'])->name('sales.show');
Route::post('/ventas/{order}/ver', [SaleController::class, 'cancel'])->name('sales.cancel');
Route::get('/ventas/{order}/print', [SaleController::class, 'print'])->name('sales.print');

Route::group([
    'prefix' => 'reportes',
    'as' => 'reports.',
], function () {
    Route::group([
        'prefix' => 'ventas',
        'as' => 'sales.',
    ], function () {
        Route::get('/ventas-del-dia', DailySalesController::class)->name('daily-sales.index');
        Route::get('/ventas-por-producto', ProductSalesController::class)->name('product-sales.index');
    });
    
    Route::group([
        'prefix' => 'inventario',
        'as' => 'inventory.',
    ], function () {
        Route::get('/conteo', InventoryCountController::class)->name('count.index');
    });
});
