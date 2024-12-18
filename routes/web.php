<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;


Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/login', function () {
    return 'Hello';
});


Route::get('/dashboard', function () {
    return view('app');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::post('/update-user-column-visibilities', [ProfileController::class, 'updateUserColumnVisibilities']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //git code here
    Route::resource('change-password', ChangePasswordController::class);
});

require __DIR__.'/auth.php';
