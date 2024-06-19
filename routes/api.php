<?php

use App\Modules\Games\Controllers\GamesController;
use App\Modules\Players\Controllers\PlayersController;
use App\Modules\Teams\Controllers\TeamsController;
use App\Modules\Authentication\Controllers\LogoutController;
use App\Modules\Public\Controllers\LoginController;
use App\Modules\Public\Controllers\RegisterController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group(['middleware' => []], function () {

    // Public endpoints

    Route::withoutMiddleware([])->group(function () {
        Route::post('/auth/register', [RegisterController::class, 'register'])->name('auth.register');
        Route::post('/auth/login', [LoginController::class, 'login'])->name('auth.login');

    });

    // Private Auth
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/auth/logout', [LogoutController::class, 'logout'])->name('auth.logout');
        // TODO: auth/me, pass recovery
    });


    // Private Apps
    Route::middleware(['auth:api'])->group(function () {
        Route::resource('teams', TeamsController::class);
        Route::resource('players', PlayersController::class);
        Route::resource('games', GamesController::class);
    });
});
