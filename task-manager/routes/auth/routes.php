<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;




Route::group(
    [
        'prefix' => 'auth',
        'middleware' => 'api'
    ],
    function () {
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,"login"]);
    Route::post('logout', [AuthController::class,"logout"]);
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
