<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Restaurant\MenuController;
use App\Http\Controllers\Restaurant\RestaurantController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


// Routes for restaurant owners & operators
Route::middleware(['auth', 'verified', 'checkrole:restaurant owner|operator'])->prefix('restaurant')->group(function () {
    Route::get('/',  [RestaurantController::class, 'dashboard'])->name('restaurant.dashboard');
    Route::resource('menus', MenuController::class)->except(['show']);
    Route::get('menus/{menu}', [MenuController::class, 'show'])->name('menus.show');
});





// Routes for admins
Route::middleware(['auth', 'verified', 'checkrole:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Other routes for admins...
});




// this route unauthorized
Route::get('/not-authorized', function () {
    return 'You are not authorized to access this page.';
})->name('not.authorized');



// this route for non route
Route::fallback(fn () => 'not found page');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
