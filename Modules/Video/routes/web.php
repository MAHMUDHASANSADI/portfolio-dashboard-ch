<?php

use Illuminate\Support\Facades\Route;
use Modules\Video\App\Http\Controllers\VideoController;

Route::middleware('auth')->group(function () {
    Route::resource('video', VideoController::class);
});
