<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Statistic;
use App\Models\Subscription;
use Illuminate\Http\Request;
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


    public function menuResturant($restaurantName, Request $request)
    {
        //get resturnat by name
        $restaurant = Restaurant::where('name', $restaurantName)->firstOrFail();




        //get all items menu
        $menuItemsQuery = $restaurant->items();

        //get all categories
        $Categories = $restaurant->menus();

        //checck if there is a filter with category filter it
        if ($request->has('category')) {
            $menuItemsQuery->where('menu_id', $request->input('category'));
        }

        $menuItems = $menuItemsQuery->get();

        return view('menu', compact('menuItems', 'Categories'));
    }
}
