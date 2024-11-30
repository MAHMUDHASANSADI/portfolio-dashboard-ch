<?php

use Illuminate\Support\Facades\Route;
use Modules\BusinessCategory\App\Http\Controllers\BusinessCategoryController;



Route::middleware('auth')->group(function() {
    Route::resource('business_category', BusinessCategoryController::class);
});
