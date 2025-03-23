<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::put('/update', [UserController::class, 'update']);
    Route::delete('/delete', [UserController::class, 'destroy']);
    Route::get('/films', [FilmController::class, 'index']);
    Route::post('/filmstore', [FilmController::class, 'store']);
    Route::put('/filmupdate/{id}', [FilmController::class, 'update']);
    Route::delete('/deletefilm/{id}', [FilmController::class, 'destroy']);
    Route::Post('/sessionstore', [SessionController::class, 'store']);
    Route::put('/sessionupdat/{id}', [SessionController::class, 'update']);
    Route::delete('/deletesession/{id}', [SessionController::class, 'destroy']);
    Route::get('/filter/{type}', [SessionController::class, 'filter']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
