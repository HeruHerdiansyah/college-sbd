<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RegisterPasienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', 'register')->name('register');
        Route::post('register', 'registerSave')->name('register.save');
    
        Route::get('login', 'login')->name('login');
        Route::post('login', 'loginAction')->name('login.action');
    });
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::controller(PasienController::class)->prefix('pasien')->group(function () {
            Route::get('', 'index')->name('pasien');
            Route::get('table', 'table')->name('pasien.table');
            Route::get('export', 'export')->name('pasien.export');
            Route::get('create', 'create')->name('pasien.create');
            Route::post('store', 'store')->name('pasien.store');
            Route::get('edit/{id}', 'edit')->name('pasien.edit');
            Route::post('edit/{id}', 'update')->name('pasien.update');
            Route::delete('destroy/{id}', 'destroy')->name('pasien.destroy');
        });
    });

    Route::controller(RegisterPasienController::class)->prefix('register-pasien')->group(function () {
        Route::get('', 'index')->name('register-pasien');
        Route::get('table', 'table')->name('register-pasien.table');
        // Route::post('custom-search', 'search')->name('register-pasien.search');
        Route::get('export', 'export')->name('register-pasien.export');
        Route::get('create', 'create')->name('register-pasien.create');
        Route::post('store', 'store')->name('register-pasien.store');
        Route::get('pay/{id}', 'edit')->name('register-pasien.edit');
        Route::post('pay/{id}', 'update')->name('register-pasien.update');
        Route::delete('destroy/{id}', 'destroy')->name('register-pasien.destroy');
    });
 
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});