<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UserController;
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

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::get('companies', [CompanyController::class, 'index']);
Route::get('projects', [ProjectController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('companies/store', [CompanyController::class, 'store']);
    Route::get('companies/{id}/show', [CompanyController::class, 'show']);
    Route::put('companies/{id}/update', [CompanyController::class, 'update']);
    Route::delete('companies/{id}/destroy', [CompanyController::class, 'destroy']);

    Route::post('projects/store', [ProjectController::class, 'store']);
    Route::get('projects/{id}/show', [ProjectController::class, 'show']);
    Route::put('projects/{id}/update', [ProjectController::class, 'update']);
    Route::delete('projects/{id}/destroy', [ProjectController::class, 'destroy']);
    Route::get('projects/{id}/get-users', [ProjectController::class, 'getUsers']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}/show', [UserController::class, 'show']);
    Route::put('users/{id}/update', [UserController::class, 'update']);
    Route::delete('users/{id}/destroy', [UserController::class, 'destroy']);

});
