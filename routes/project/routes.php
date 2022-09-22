<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// define admin routes here

    Route::post('/create',[ProjectController::class, 'store']);
    Route::get('users/{userID}/get-projects',[ProjectController::class,'index']);
        /**
         * get-all-projects
         * get-projects
         * remove-multiple-projects
         * store
         * update
         * destroy
         * index
         * show{userID}{projectID}
         */


