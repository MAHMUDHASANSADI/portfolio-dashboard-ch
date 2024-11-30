<?php

use Illuminate\Support\Facades\Route;
use Modules\Message\App\Http\Controllers\MessageController;


Route::middleware('auth')->group(function () {
    Route::resource('messages', MessageController::class);
});
