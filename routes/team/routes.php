<?php


use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;




Route::group(
    ['prefix' => 'team'],
    function() {
        /**
         * update
         * show-all-teams
         */


        Route::post('get-teams',[TeamController::class,'getTeams']); // show teams with paginator
        Route::get('get-team-leader',[TeamController::class,'getTeamLeader']);
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

