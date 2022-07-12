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

Route::post('/player', [AuthController::class, 'register'])->name('register'); // crea un jugador/a.
Route::post('/login', [AuthController::class, 'login'])->name('login'); // Loguea jugador/a.

Route::middleware('auth:api')->group(function(){
    Route::get('/index', [UserController::class, 'index'])->name('index'); // Muestra todos los users

    Route::put('/players/{id}', [UserController::class, 'update'])->name('update'); // modifica el nom del jugador/a.
    
    Route::post('/players/{id}/games', [GameController::class, 'throw'])->name('throw'); // un jugador/a específic realitza una tirada dels daus.
    Route::delete('/players/{id}/games', [GameController::class, 'delete'])->name('delete'); // elimina les tirades del jugador/a.
    Route::get('/players', [GameController::class, 'allAverage'])->name('allAverage'); // retorna el llistat de tots els jugadors/es del sistema amb el seu percentatge mitjà d’èxits
    Route::get('/players/{id}/games', [GameController::class, 'show'])->name('show'); // retorna el llistat de jugades per un jugador/a.
    Route::get('/players/ranking', [GameController::class, 'ranking'])->name('ranking'); // retorna el rànquing mitjà de tots els jugadors/es del sistema. És a dir, el percentatge mitjà d’èxits.
    Route::get('/players/ranking/loser', [GameController::class, 'rankingLoser'])->name('rankingLoser'); // retorna el jugador/a amb pitjor percentatge d’èxit.
    Route::get('/players/ranking/winner', [GameController::class, 'rankingWinner'])->name('rankingWinner'); // retorna el jugador/a amb millor percentatge d’èxit.
});