<?php

use App\Http\Controllers\CommentController;
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

Route::put('updateUser/{id}', [DataController::class, 'update']);
Route::delete('/deleteUser/{id}', [DataController::class, 'destroy']);
Route::post('/createUser', [DataController::class, 'store']);
Route::get('findUser/{id}', [DataController::class, 'show']);
Route::get('/getUsers', [DataController::class, 'index']);

Route::put('/updateComment/{id}', [CommentController::class, 'update']);
Route::delete('/deleteComment/{id}', [CommentController::class, 'destroy']);
Route::post('/createComment', [CommentController::class, 'store']);
Route::get('findComment/{id}', [CommentController::class, 'show']);
Route::get('/getComments', [CommentController::class, 'index']);

Route::get('/getFeed',[ MakeFeedRequestController::class,'getFeed']);
