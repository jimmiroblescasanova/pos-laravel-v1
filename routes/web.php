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
use App\Http\Controllers\GroupController;
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
    Route::get('/', AccessController::class)->name('index')->middleware('can:users_access,roles_access');

    Route::group([
        'controller' => RoleController::class,
        'prefix' => '/roles', 
        'as' => 'roles.', 
        'middleware' => 'can:roles_access'
    ], function () {
        Route::get('/nuevo', 'create')->name('create')->middleware('can:roles_create');
        Route::post('/nuevo', 'store')->name('store')->middleware('can:roles_create');
        Route::get('/{role:name}/edit', 'edit')->name('edit')->middleware('can:roles_edit');
        Route::post('/{role:name}/edit', 'update')->name('update')->middleware('can:roles_edit');
        Route::delete('/{role:name}/edit', 'destroy')->name('destroy')->middleware('can:roles_delete');
    });

    Route::group([
        'controller' => UserController::class,
        'prefix' => '/usuarios',
        'as' => 'users.',
        'middleware' => 'can:users_access'
    ], function () {
        Route::get('/nuevo', 'create')->name('create')->middleware('can:users_create');
        Route::post('/nuevo', 'store')->name('store')->middleware('can:users_create');
        Route::get('/{user}/editar', 'edit')->name('edit')->middleware('can:users_edit');
        Route::patch('/{user}/editar', 'update')->name('update')->middleware('can:users_edit');
        Route::delete('/{user}/editar', 'destroy')->name('destroy')->middleware('can:users_delete');
    });
});

Route::group([
    'controller' => ProductController::class,
    'prefix' => '/productos',
    'as' => 'products.',
    'middleware' => 'can:products_access'
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/nuevo', 'create')->name('create')->middleware('can:products_create');
    Route::post('/nuevo', 'store')->name('store')->middleware('can:products_create');
    Route::post('/descargar', 'download')->name('download');
    Route::get('/importar', 'import')->name('import');
    Route::post('/importar', 'handleImport')->name('handleImport');
    Route::get('/{product}/editar', 'edit')->name('edit')->middleware('can:products_edit');
    Route::patch('/{product}/editar', 'update')->name('update')->middleware('can:products_edit');
    Route::delete('/{product}/editar', 'destroy')->name('destroy')->middleware('can:products_delete');
});

Route::group([
    'controller' => InventoryController::class, 
    'prefix' => '/inventario',
    'as' => 'inventory.',
    'middleware' => 'can:inventory_access'
], function () {
    Route::get('/','index')->name('index');
    Route::post('/','update')->name('update')->middleware('can:inventory_edit');
    Route::post('/exportar','export')->name('export');
    Route::get('/importar','import')->name('import');
    Route::post('/importar','handleImport')->name('handleImport')->middleware('can:inventory_edit');
});

Route::get('/pos', [OrderController::class, 'create'])->name('orders.create');
Route::delete('/pos/{order}', [OrderController::class, 'delete'])->name('orders.delete');

Route::get('/pos/{order}/pdf', [OrderController::class, 'printTicket'])->name('ticket.print');

Route::get('/configuraciones/empresa', BusinessController::class)->name('settings.business');
Route::get('/configuraciones/ticket', TicketController::class)->name('settings.ticket');

Route::get('/configuraciones/groups', [GroupController::class, 'index'])->name('settings.groups.index');
Route::post('/configuraciones/groups', [GroupController::class, 'store'])->name('settings.groups.store');
Route::delete('/configuraciones/groups', [GroupController::class, 'destroy'])->name('settings.groups.destroy');

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
