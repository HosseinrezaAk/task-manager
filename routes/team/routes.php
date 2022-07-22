<?php


use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;




Route::group(
    ['prefix' => 'team'],
    function() {
        /**
         * update
         * show-all-teams
         * get-team-leader
         */




        Route::post('delete-multiple-teams',[TeamController::class,'deleteMultiple']);
        Route::get('get-members-tasks', [TeamController::class,'getMembersTasks']);
    }
);
Route::group(
    ['prefix' => 'team','middleware'=>['auth:api', 'isActive']],
    function() {
        Route::get('get-members-tasks', [TeamController::class,'getMembersTasks']);
    }
);
Route::resource('/teams', 'TeamController')->middleware(['auth:api', 'isActive']);

