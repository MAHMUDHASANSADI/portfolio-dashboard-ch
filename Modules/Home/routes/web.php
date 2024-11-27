<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\App\Http\Controllers\SliderController;

Route::middleware('auth')->group(function () {
    Route::resource('slider', SliderController::class);
});
