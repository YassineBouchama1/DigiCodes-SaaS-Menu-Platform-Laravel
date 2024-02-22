<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Restaurant\MenuController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\Restaurant\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return 'hola';
})->name('dashboard');


// Routes for restaurant owners & operators
Route::middleware(['auth', 'verified', 'checkrole:restaurant owner|operator'])->prefix('restaurant')->group(function () {
    Route::get('/',  [RestaurantController::class, 'dashboard'])->name('restaurant.dashboard');
    Route::resource('menus', MenuController::class)->except(['show']);
    Route::get('menus/{menu}', [MenuController::class, 'show'])->name('menus.show');
    Route::resource('subscriptions', SubscriptionController::class);
    Route::post('operatores/register', [RegisteredUserController::class, 'store']);
});





// Routes for admins
Route::middleware(['auth', 'verified', 'checkrole:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('plans', PlanController::class)->except(['show']);
    Route::get('plans/{menu}', [PlanController::class, 'show'])->name('plans.show');
});




// this route unauthorized
Route::get('/not-authorized', function () {
    return 'You are not authorized to access this page.';
})->name('not.authorized');



// this route for non route



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::fallback(fn () => 'not found page');



require __DIR__ . '/auth.php';
