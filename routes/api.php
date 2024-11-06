<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\API\APIController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('business-categories', [APIController::class, 'businessCategories']);
Route::get('business-category/{id}', [APIController::class, 'businessCategory']);
