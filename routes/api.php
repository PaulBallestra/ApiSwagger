<?php

use App\Http\Controllers\ApiTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//REGISTER
Route::post('auth/register', [ApiTokenController::class, 'register']);

//LOGIN
Route::post('auth/login', [ApiTokenController::class, 'login']);
