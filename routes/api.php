<?php

use App\Http\Controllers\ApiController as ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/axios', [ApiController::class, 'axios'])->name('api');

//Route::resource('module', ApiController::class);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });