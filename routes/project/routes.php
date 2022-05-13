<?php

use Illuminate\Support\Facades\Route;

// define admin routes here
Route::group(
    ['prefix' => 'projects'],
    function() {
        /**
         * get-all-projects
         * get-projects
         * remove-multiple-projects
         */

//        /**
//         * define REST route
//         */
//        Route::post('', 'ProjectController@store');
//        Route::post('/{id}', 'ProjectController@update');
//        Route::delete('/{id}', 'ProjectController@destroy');
    }
);
//
//Route::group(
//    ['prefix' => 'projects', 'middleware' => ['auth:api', 'isActive']],
//    function () {
//        Route::get('{userID}', 'ProjectController@index');
//        Route::get('/{userID}/{projectID}', 'ProjectController@show');
//    }
//);
