<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        // $permissions =  $user->getAllPermissions();
        // dd($permissions);
        return view('restaurant.dashboard');
    }
}
