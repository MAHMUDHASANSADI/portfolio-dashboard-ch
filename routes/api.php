<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\API\APIController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('business-categories', [APIController::class, 'businessCategories']);
Route::get('business-category/{id}', [APIController::class, 'businessCategory']);
Route::get('award-categories', [APIController::class, 'awardCategory']);
Route::get('award-category/{id}', [APIController::class, 'awardCategory']);
Route::get('biography', [APIController::class, 'biography']);
Route::get('hero',[APIController::class, 'hero']);
Route::get('blog',[APIController::class,'blog']);
Route::get('gallery',[APIController::class,'gallery']);
Route::get('slider',[APIController::class,'slider']);
Route::get('program',[APIController::class,'program']);
Route::get('news',[APIController::class,'news']);

Route::post('contact-us', [APIController::class,'contactUs']);
