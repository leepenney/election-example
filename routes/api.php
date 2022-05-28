<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\ResponseController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/constituencies', [ConstituencyController::class, 'index']);
Route::get('/parties', [PartyController::class, 'index']);

Route::prefix('/responses')->group( function() {
    Route::get('/all', [ResponseController::class, 'index']);
    Route::post('/store', [ResponseController::class, 'store']);
    Route::get('/{constituency}', [ResponseController::class, 'show']);
});