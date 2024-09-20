<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RefMaterialController;
use App\Http\Controllers\RefSupplierController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('erp')->group(function () {
    Route::middleware('auth')->group(function () {
        // Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/', function () {
            $menuDasbor = 'active';

            return view('dashboard', compact('menuDasbor'));
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('/pengaturan')->group(function () {
            // User
            Route::resource('user', UserController::class);
            // Route::get('/user', [UserController::class, 'index'])->name('user.index');
            // List all roles
            Route::get('/role', [RolesController::class, 'index'])->name('roles.index');
        });

        Route::prefix('/master')->group(function () {
            // Master Material
            Route::resource('/ref-material', RefMaterialController::class);

            // Master Supplier
            Route::resource('/ref-supplier', RefSupplierController::class);
        });

        Route::prefix('/pembelian')->group(function () {
            // Purchase Order
            // Route::resource('/', PurchaseOrderController::class);

            // List all purchase orders
            Route::get('/', [PurchaseOrderController::class, 'index'])->name('pembelian.index');

            // Show form to create new purchase order
            Route::get('/create', [PurchaseOrderController::class, 'create'])->name('pembelian.create');

            // Store new purchase order
            Route::post('/pembelian', [PurchaseOrderController::class, 'store'])->name('pembelian.store');

            // Show specific purchase order
            Route::get('/detail/{pembelian}', [PurchaseOrderController::class, 'show'])->name('pembelian.show');

            // Show form to edit specific purchase order
            Route::get('/{pembelian}/edit', [PurchaseOrderController::class, 'edit'])->name('pembelian.edit');

            // Update specific purchase order
            Route::put('/update/{pembelian}', [PurchaseOrderController::class, 'update'])->name('pembelian.update');

            // Delete specific purchase order
            Route::delete('/delete/{pembelian}', [PurchaseOrderController::class, 'destroy'])->name('pembelian.destroy');

            Route::get('get-supplier', [PurchaseOrderController::class, 'getSupplier']);
            Route::get('get-material', [PurchaseOrderController::class, 'getMaterial']);
            Route::get('get-salesperson', [PurchaseOrderController::class, 'getSalesperson']);
        });

        // Gudang
        Route::resource('gudang', GudangController::class);
    });
});

require __DIR__.'/auth.php';
