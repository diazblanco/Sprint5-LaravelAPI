<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/player', [AuthController::class, 'register'])->name('register'); //POST /players : crea un jugador/a.
Route::post('/login', [AuthController::class, 'login'])->name('login'); //loguea jugador/a.

Route::middleware('auth:api')->group(function(){
    Route::get('/index', [UserController::class, 'index'])->name('index');

});


