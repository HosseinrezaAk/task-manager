<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// define admin routes here
Route::group(
    ['prefix' => 'users'],
    function () {

        /**
         * get-users: for showing all the users
         * delete-multiple-users
         */

//        // todo make this REST, this should be integrated into update action
//        Route::patch('change-password', 'UserController@changePassword');
//
//        Route::get('', 'UserController@index');
//        Route::post('', 'UserController@store');
//        Route::delete('/{id}', 'UserController@destroy');
//
//
//        Route::get('show-user-teams', [UserController::class, 'showUserTeams']);
    }
);

//Route::group(
//    ['prefix' => 'users', 'middleware' => ['auth:api', 'isActive']],
//    function () {
//        Route::get('/{userID}', 'UserController@show');
//        Route::patch('/{id}', 'UserController@update');
//    }
//);

