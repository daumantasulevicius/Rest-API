<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\MakeFeedRequestController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('update/{id}', [DataController::class, 'update']);
Route::delete('/delete/{id}', [DataController::class, 'destroy']);
Route::post('/create', [DataController::class, 'store']);
Route::get('find/{id}', [DataController::class, 'show']);
Route::get('/get', [DataController::class, 'index']);
Route::get('/getFeed',[MakeFeedRequestController::class,'getFeed']);
Route::get('/filter', [DataController::class, 'filter']);
Route::get('/search/{phrase}', [DataController::class, 'search']);
