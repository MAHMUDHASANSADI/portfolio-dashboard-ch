<?php

use Illuminate\Support\Facades\Route;
use Modules\Biography\App\Http\Controllers\BiographyController;

Route::middleware('auth')->group(function () {
    Route::resource('biography', BiographyController::class);
});
