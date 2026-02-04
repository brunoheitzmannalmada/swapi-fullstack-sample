<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StarWarsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\StatisticsController;

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

Route::get('/star-wars/people', [StarWarsController::class, 'search']);
Route::get('/star-wars/people/{id}', [StarWarsController::class, 'details']);

Route::get('/star-wars/movies', [MoviesController::class, 'index']);
Route::get('/star-wars/movies/{id}', [MoviesController::class, 'show']);

Route::get('/star-wars/statistics', [StatisticsController::class, 'index']);