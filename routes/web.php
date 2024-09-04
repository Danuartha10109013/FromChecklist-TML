<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AutoLogout;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware([AutoLogout::class])->group(function () {
    // Admin routes group with middleware and prefix
    Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {

        Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

        // Form
        Route::prefix('form')->group(function () {
            Route::get('/',[FormController::class,'index'])->name('form');
            Route::get('/add',[FormController::class,'create'])->name('form-add');
            Route::get('/edit/{id}',[FormController::class,'edit'])->name('form-edit');
            Route::put('/update/{id}',[FormController::class,'update'])->name('form-update');
            Route::post('/store',[FormController::class,'store'])->name('form-store');
            Route::get('/{id}',[FormController::class,'show'])->name('form-show');
            Route::get('/active/{id}',[FormController::class,'active'])->name('form-active');
            Route::get('/inactive/{id}',[FormController::class,'inactive'])->name('form-inactive');
            Route::get('/delete/{id}',[FormController::class,'destroy'])->name('form-delete');
            Route::get('/form-add/{id}', [FormController::class, 'add_form'])->name('form-add-list');
            Route::put('/form-save/{id}', [FormController::class, 'saveForm'])->name('form-add-save');
            Route::get('/form-edit/{id}', [FormController::class, 'editForm'])->name('form-add-edit');
            Route::put('/form-update/{id}', [FormController::class, 'updateForm'])->name('form-add-update');

            
        });
        //User
        Route::prefix('user')->group(function () {
            Route::get('/',[UserController::class,'index'])->name('user');
            Route::get('/add',[UserController::class,'create'])->name('user-add');
            Route::post('/store',[UserController::class,'store'])->name('user-store');
            Route::get('/edit/{id}',[UserController::class,'edit'])->name('user-edit');
            Route::put('/update/{id}',[UserController::class,'update'])->name('user-update');
            Route::get('/active/{id}',[UserController::class,'active'])->name('user-active');
            Route::get('/inactive/{id}',[UserController::class,'inactive'])->name('user-inactive');
            Route::get('/delete/{id}',[UserController::class,'destroy'])->name('user-delete');
        });


    });

    Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

});


