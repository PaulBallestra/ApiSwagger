<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//REGISTER
Route::post('auth/register', [ApiTokenController::class, 'register']);

//LOGIN
Route::post('auth/login', [ApiTokenController::class, 'login']);

//CREATE TASK
Route::middleware('auth:sanctum')->post('auth/task/create', [TaskController::class, 'create']);

//DELETE TASK
Route::middleware('auth:sanctum')->delete('auth/task/{id}', [TaskController::class, 'delete']);
