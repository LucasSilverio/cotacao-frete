<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('cotacao', 'App\Http\Controllers\CotacaoController');
Route::post('/cotacao', [\App\Http\Controllers\CotacaoController::class, 'store']);
Route::put('/cotacao', [\App\Http\Controllers\CotacaoController::class, 'calculo']);
Route::get('/cotacao', [\App\Http\Controllers\CotacaoController::class, 'show']);
Route::apiResource('transportadora', 'App\Http\Controllers\TransportadoraController');
