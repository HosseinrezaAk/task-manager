<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



        Route::post('/create',[UserController::class,'store']);
        Route::get('/',[UserController::class,'index']);
        Route::delete('/delete/{id}',[UserController::class,'destroy']);

        /**
         * get-users: for showing all the users
         * delete-multiple-users
         * change-password : Hard
         * index : to show
         * store : to create data and store in DB
         * destroy: to delete a data with given ID form DB
         * show-user-teams : to show the user's teams
         * show: to show specific user
         * update : to update single row
         */

