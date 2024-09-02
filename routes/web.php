<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AutoLogout;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([AutoLogout::class])->group(function () {
    // Admin routes group with middleware and prefix
    Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {

        Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

    });

    Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

});


