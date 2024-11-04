<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\AwardCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\VideoController;



Route::get('/', function () {
    return view('app');
});

Route::resource('home', HomeController::class);
Route::resource('biography', BiographyController::class);
Route::resource('business', BusinessController::class);
Route::resource('business_category', BusinessCategoryController::class);
Route::resource('award', AwardController::class);
Route::resource('award_category', AwardCategoryController::class);
Route::resource('blog', BlogController::class);
Route::resource('video', VideoController::class);

