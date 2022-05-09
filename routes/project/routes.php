<?php

use Illuminate\Support\Facades\Route;

// define admin routes here
Route::group(
    ['prefix' => 'projects'],
    function() {
        /**
         * get-all-projects
         *
         */

//        Route::post('get-projects', 'ProjectController@getProjects');
//        // todo make this REST, this should be destroy action
//        Route::post('multi-remove-projects', 'ProjectController@multiRemoveProjects');
//        // todo make this REST, this should be like /projects/{id}/image/{id}
//        Route::post('remove-project-image', 'ProjectController@removeProjectImage');
//
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
