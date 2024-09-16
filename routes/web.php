<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefMaterialController;
use App\Http\Controllers\RefSupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $menuDasbor = 'active';

    return view('dashboard', compact('menuDasbor'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User
    Route::resource('user', UserController::class);
    // Route::get('/user', [UserController::class, 'index'])->name('user.index');

    // Master Material
    Route::resource('master/ref-material', RefMaterialController::class);

    // Master Supplier
    Route::resource('master/ref-supplier', RefSupplierController::class);
});

require __DIR__.'/auth.php';
