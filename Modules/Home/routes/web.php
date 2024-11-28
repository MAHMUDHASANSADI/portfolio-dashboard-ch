<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\App\Http\Controllers\SliderController;
use Modules\Home\App\Http\Controllers\HeroController;
use Modules\Home\App\Http\Controllers\GalleryController;
use Modules\Home\App\Http\Controllers\ProgramController;
use Modules\Home\App\Http\Controllers\NewsController;

Route::middleware('auth')->group(function () {
    Route::resource('slider', SliderController::class);
    Route::resource('hero', HeroController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('news', NewsController::class);
});
