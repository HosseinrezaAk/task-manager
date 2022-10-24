<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::post('/create/{creatorID}',[TaskController::class,'store']);
/**
 *
 */


