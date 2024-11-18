<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\AwardCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\VideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::resource('home', HomeController::class);
    Route::resource('slider', SliderController ::class);
    Route::resource('hero', HeroController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('news', NewsController::class);
    Route::resource('biography', BiographyController::class);
    Route::resource('business', BusinessController::class);
    Route::resource('business_category', BusinessCategoryController::class);
    Route::resource('award', AwardController::class);
    Route::resource('award_category', AwardCategoryController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('video', VideoController::class);
});

require __DIR__.'/auth.php';
