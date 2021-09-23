<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Cache::flush();
// dd(Cache::get('2'));
// Cache::put('1', ' 2222222222',);

Route::view('/', 'home.index')->name('home')->middleware('log');
Route::redirect('/home', '/');

Route::middleware('guest')->group(function () {
    Route::redirect('modules', 'module')->name('modules');
    //Route::redirect('module', 'login');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');

    Route::get('module', [ModuleController::class, 'index'])->name('module');
    Route::get('module/{module}', [ModuleController::class, 'show'])->name('module.show');
});


// Route::middleware('auth')->group(function () {
//     Route::redirect('modules', 'module');

//     Route::get('module', [ModuleController::class, 'index'])->name('module');
//     Route::get('module/{module}', [ModuleController::class, 'show'])->name('module.show');
// });

// Route::prefix('module')->as('module.')->group(function () {
//     Route::get('module')->name('module');
//     Route::get('{id}', [ModuleController::class, 'show'])->name('show');
// });