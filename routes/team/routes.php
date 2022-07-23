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
         * delete-multiple-team
         * get-member-task : team leader will see the tasks of specific member
         */

    }
);

Route::resource('/teams', 'TeamController')->middleware(['auth:api', 'isActive']);

