<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantOwner\RestaurantOwnerController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });



// Routes for restaurant owners
Route::middleware(['auth', 'verified', 'checkrole:restaurant owner|operator'])->prefix('restaurant')->group(function () {
    Route::get('dashboard', fn () => 'hola')->name('restaurant.dashboard');
    // Other routes for restaurant owners...
});

// Routes for admins
Route::middleware(['auth', 'verified', 'checkrole:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Other routes for admins...
});



Route::get('/not-authorized', function () {
    return 'You are not authorized to access this page.';
})->name('not.authorized');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
