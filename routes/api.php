<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;

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
Route::get('posts', [\App\Http\Controllers\Api\PostController::class, 'index']);


Route::post('/register', [\App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('posts/create', [\App\Http\Controllers\Api\PostController::class, 'store']);
    Route::put('posts/edit/{post}', [\App\Http\Controllers\Api\PostController::class, 'update']);
    Route::delete('posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'destroy']);
});
