<?php

use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});


Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

//User
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'show']);
Route::post('/user', [\App\Http\Controllers\UserController::class, 'store']);
Route::put('/euser/{id}', [\App\Http\Controllers\UserController::class, 'update']);
Route::delete('/duser/{id}', [\App\Http\Controllers\UserController::class, 'delete']);

//Student
Route::get('/students', [\App\Http\Controllers\StudentController::class, 'index']);
Route::get('/student/{id}', [\App\Http\Controllers\StudentController::class, 'show']);
Route::post('/student', [\App\Http\Controllers\StudentController::class, 'store']);
Route::put('/edit/{id}', [\App\Http\Controllers\StudentController::class, 'update']);
Route::delete('/delete/{id}', [\App\Http\Controllers\StudentController::class, 'delete']);

