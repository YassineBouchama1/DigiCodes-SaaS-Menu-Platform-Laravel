<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;

use App\Models\Statistic;
use App\Models\Subscription;

use Illuminate\Support\Facades\Auth;


class RestaurantController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $limits = Subscription::where('restaurant_id', $user->restaurant_id)
            ->where('status', 'active')
            ->first()->plan;

        $resturantStatistic = Statistic::where('restaurant_id', $user->restaurant_id)
            ->first();

        // dd($limits);
        // dd($resturantStatistic);
        return view('restaurant.dashboard', compact('limits', 'resturantStatistic'));
    }

    public function qrcode()
    {
        $user = Auth::user();
        // $permissions =  $user->getAllPermissions();
        // dd($permissions);


        return view('restaurant.dashboard');
    }


    public function statics()
    {
        return $limits = Subscription::where('restaurant_id', Auth::user()->restaurant_id)->plan;
    }
}
