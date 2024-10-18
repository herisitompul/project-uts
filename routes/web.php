<?php

use App\Http\Middleware\Admin\AuthMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\LowonganController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', action: 'AdminController@Login')->name('admin.login');
    Route::middleware(AuthMiddleware::class)->group(function () {
        Route::get('dashboard', 'AdminController@Dashboard')->name('admin.dashboard');
        Route::get('logout', 'AdminController@Logout')->name('admin.logout');
    });
});

// routes/web.php
Route::get('/user/dashboard', [ProdukController::class, 'dashboard'])->name('user.dashboard');
Route::get('/user/dashboard', [LowonganController::class, 'dashboard'])->name('user.dashboard');


Route::get('/komunitas/create', [KomunitasController::class, 'create'])->name('komunitas.create');
Route::post('/komunitas', [KomunitasController::class, 'store'])->name('komunitas.store');
Route::get('/komunitas', [KomunitasController::class, 'index'])->name('komunitas.index');
Route::delete('/komunitas/{id}', [KomunitasController::class, 'destroy'])->name('komunitas.destroy');
Route::get('/komunitas/{id}/edit', [KomunitasController::class, 'edit'])->name('komunitas.edit');
Route::put('/komunitas/{id}', [KomunitasController::class, 'update'])->name('komunitas.update');
Route::get('/komunitas/{id}', [KomunitasController::class, 'show'])->name('komunitas.show');


Route::get('/lowongan/create', [LowonganController::class, 'create'])->name('lowongan.create');
Route::post('/lowongan', [LowonganController::class, 'store'])->name('lowongan.store');
Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
Route::get('/lowongan/{id}/edit', [LowonganController::class, 'edit'])->name('lowongan.edit');
Route::put('/lowongan/{id}', [LowonganController::class, 'update'])->name('lowongan.update');



Auth::routes();
