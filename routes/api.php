<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\MovieController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/characters/{name}/edit', [CharacterController::class, 'update']);
});
//Route::post('/auth/register', [ApiAuthController::class, 'create']);
Route::post('/auth/login', [ApiAuthController::class, 'login']);

Route::get('/characters', [CharacterController::class, 'index']);
Route::get('/characters/{name}', [CharacterController::class, 'show']);
Route::get('/characters_names', [CharacterController::class, 'listNames']);
Route::get('/movies', [MovieController::class, 'index']);
