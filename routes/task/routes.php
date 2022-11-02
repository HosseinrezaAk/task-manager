<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::post('/create/{creatorID}/projects/{projectID}',[TaskController::class,'store']);
Route::get('/{taskID}',[TaskController::class,'show']);
Route::delete('/{taskID}',[TaskController::class, 'destroy']);
/**
 *
 */


