<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::get('refreshtoken', [AuthController::class, 'getTokenAndRefreshToken']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::resource('posts', PostController::class);
    Route::resource('category', CategoryController::class);
});
