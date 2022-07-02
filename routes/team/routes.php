<?php


use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;




    Route::post('/create',[TeamController::class,'store']);
    Route::get('/{id}',[TeamController::class,'show']);
    Route::get('/',[TeamController::class,'index']);
    Route::delete('/{id}',[TeamController::class,'destroy']);
    Route::patch('/{id}',[TeamController::class,'update']);
        /**
         * update
         * show-all-teams
         * get-team-leader
         * delete-multiple-team
         * get-member-task : team leader will see the tasks of specific member
         */

