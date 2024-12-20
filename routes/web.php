<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\Sessions;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function () {
    Route::get('/', [Sessions::class, 'index'])->name('login');
    Route::post('/', [Sessions::class, 'login'])->name('login');
});

Route::get('/logout', [Sessions::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/admin/users/manage', [AdminController::class, 'manageUsers'])->name('admin.manage.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.create.users');
    Route::post('/admin/users/store', [AdminController::class, 'storeUser'])->name('admin.store.user');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.edit.user');
    Route::patch('/admin/users/{user}/update', [AdminController::class, 'updateUser'])->name('admin.update.user');
    Route::middleware("skipView")->get('/admin/users/{user}', [AdminController::class, 'showUser'])->name('admin.show.user');
    Route::get('/admin/user/{user}/delete', [AdminController::class, 'destroyUser'])->name('admin.destroy.user');

    Route::get('/admin/products/manage', [AdminController::class, 'manageProducts'])->name('admin.manage.products');
    Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.create.products');
    Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('admin.store.products');
    Route::get('/admin/products/{product}', [AdminController::class, 'showProduct'])->name('admin.show.product');
    Route::get('/admin/product/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.edit.product');
    Route::put('/admin/product/{product}/update', [AdminController::class, 'updateProduct'])->name('admin.update.product');
    Route::get('/admin/product/{product}/delete', [AdminController::class, 'destroyProduct'])->name('admin.destroy.product');


    Route::get('/admin/sales/manage', [AdminController::class, 'manageSales'])->name('admin.manage.sales');
    Route::get('/admin/sales/show/{sale}', [AdminController::class, 'showSale'])->name('admin.show.sale');

//   Route::get("/admin/settings", [AdminController::class, 'settings'])->name('admin.test');

});


Route::middleware(['auth', 'role:cashier'])->group(function () {
    Route::get('/cashier/dashboard', [CashierController::class, 'dashboard'])->name('cashier.dashboard');
    Route::get("/cashier/sale/create", [CashierController::class, 'createSale'])->name('cashier.create.sale');
    Route::get("/cashier/settings", [CashierController::class, 'settings'])->name('cashier.settings');
    Route::post("/cashier/resetPassword", [CashierController::class, 'resetPassword'])->name('cashier.resetPassword');
});



