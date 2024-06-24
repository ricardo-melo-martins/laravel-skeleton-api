<?php

use App\Modules\Authentication\Controllers\AuthController;
use App\Modules\Games\Controllers\GamesController;
use App\Modules\Players\Controllers\PlayersController;
use App\Modules\Teams\Controllers\TeamsController;
use App\Modules\Authentication\Controllers\LogoutController;
use App\Modules\Public\Controllers\LoginController;
use App\Modules\Public\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'home' => true
    ]);
});


Route::get('/health-check', function () {
    return response()->json([
        'success' => true,
        'health' => true
    ]);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function ($router) {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'userProfile']); 
    
});


Route::group([
    'middleware' => ['api', 'header.authorization'],
    'prefix' => 'v1',
], function ($router) {
    
    # TEAMS
    Route::get('/teams', TeamsController::class .'@index')->name('teams.index');
    Route::post('/teams', TeamsController::class .'@store')->name('teams.store');
    Route::get('/teams/{teamId}', TeamsController::class .'@show')->name('teams.show');
    Route::put('/teams/{teamId}', TeamsController::class .'@update')->name('teams.update');    
    Route::delete('/teams/{teamId}', TeamsController::class .'@destroy')->name('teams.destroy');
    
    # PLAYERS
    Route::get('/players', PlayersController::class .'@index')->name('players.index');
    Route::post('/players', PlayersController::class .'@store')->name('players.store');
    Route::get('/players/{playerId}', PlayersController::class .'@show')->name('players.show');
    Route::put('/players/{playerId}', PlayersController::class .'@update')->name('players.update');    
    Route::delete('/players/{playerId}', PlayersController::class .'@destroy')->name('players.destroy');
        
    # GAMES
    Route::get('/games', GamesController::class .'@index')->name('games.index');
    Route::post('/games', GamesController::class .'@store')->name('games.store');
    Route::get('/games/{gameId}', GamesController::class .'@show')->name('games.show');
    Route::put('/games/{gameId}', GamesController::class .'@update')->name('games.update');    
    Route::delete('/games/{gameId}', GamesController::class .'@destroy')->name('games.destroy');
  
});

