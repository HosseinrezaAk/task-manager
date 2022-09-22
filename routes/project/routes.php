<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// define admin routes here

    Route::post('/create',[ProjectController::class, 'store']);
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


