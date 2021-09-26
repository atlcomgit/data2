<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::redirect('/home', '/')->name('home');
Route::get('/', HomeController::class)->name('pages.home')->middleware('log');
// Route::view('/', 'home.index')->name('pages.home')->middleware('log');
//Route::redirect('/module', '/login');
// Route::get('/', function () { return view('pages.home.index'); });

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login'])->name('pages.auth.login');
    Route::post('/login', [AuthController::class, 'check'])->name('pages.auth.login.check');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('pages.auth.logout');
});

//Route::prefix('module')->as('pages.')->group(function () {
Route::redirect('/modules', '/module')->name('pages.modules');
Route::get('/module', [ModuleController::class, 'index'])->name('pages.modules');
Route::get('/module/{module}', [ModuleController::class, 'show'])->name('pages.module.show');
// });