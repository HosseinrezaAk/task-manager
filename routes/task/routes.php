<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::post('/create/{creatorID}',[TaskController::class,'store']);
/**
 *
 */


