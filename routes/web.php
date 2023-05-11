<?php

use App\Http\Controllers\CharacterLayoutController;
use App\Http\Controllers\MovieLayoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return redirect('/characters');
});
Route::get('/characters', [CharacterLayoutController::class, 'index']);
Route::get('/characters/{name}', [CharacterLayoutController::class, 'show']);
Route::get('/characters/{name}/edit', [CharacterLayoutController::class, 'edit']);
Route::post('/characters/{name}/edit', [CharacterLayoutController::class, 'update']);
Route::get('/characters_names', [CharacterLayoutController::class, 'listNames']);
Route::get('/movies', [MovieLayoutController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
