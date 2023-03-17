<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


    Route::post('register', [AuthController::class,'register']);
//    Route::post('login', [AuthController::class,'login']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,"login"]);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
