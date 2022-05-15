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
         * store
         * update
         * destroy
         */
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
