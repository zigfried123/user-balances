<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Api\UserController::class)->group(function () {
    Route::post('/user/login', 'login');
    Route::get('/user/dashboard', 'dashboard')->middleware('auth:sanctum');
    Route::get('/user/history', 'history')->middleware('auth:sanctum');;
});


