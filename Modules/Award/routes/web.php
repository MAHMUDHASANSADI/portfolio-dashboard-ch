<?php

use Illuminate\Support\Facades\Route;
use Modules\Award\App\Http\Controllers\AwardController;


Route::middleware('auth')->group(function () {
    Route::resource('award', AwardController::class);
});
