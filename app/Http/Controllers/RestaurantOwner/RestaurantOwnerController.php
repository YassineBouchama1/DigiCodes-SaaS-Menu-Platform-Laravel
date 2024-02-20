<?php

namespace App\Http\Controllers\RestaurantOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantOwnerController extends Controller
{
    public function dashboard()
    {
        return view('restaurant.dashboard');
    }
}
