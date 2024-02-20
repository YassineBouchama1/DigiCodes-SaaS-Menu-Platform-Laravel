<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantOwner\RestaurantOwnerController;
use Illuminate\Support\Facades\Route;



// Routes for restaurant owners & operators
Route::middleware(['auth', 'verified', 'checkrole:restaurant owner|operator'])->prefix('restaurant')->group(function () {
    Route::get('dashboard',  [RestaurantOwnerController::class, 'dashboard'])->name('restaurant.dashboard');
    // Other routes for restaurant owners...
});





// Routes for admins
Route::middleware(['auth', 'verified', 'checkrole:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
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
