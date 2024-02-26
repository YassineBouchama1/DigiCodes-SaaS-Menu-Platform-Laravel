<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Statistic;
use App\Models\Subscription;
use App\Models\User;
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

        $users = Restaurant::where('id', $user->restaurant_id)->get();
        // dd($users);
        // dd($limits);
        // dd($resturantStatistic);
        return view('restaurant.dashboard', compact('limits', 'resturantStatistic', 'users'));
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
        $restaurant = Restaurant::where('name', $restaurantName)->first();




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



    /// part for resturnat update

    public function edit()
    {


        $restaurant = Restaurant::where('id', Auth::user()->restaurant_id)->first();
        return view('restaurant.setting.edit', compact('restaurant'));
    }


    public function update(Restaurant $restaurant, Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'opening_hour' => 'required',
            'closing_hour' => 'required'
        ]);

        //check if oppening hours correct
        if ($request->opening_hour >= $request->closing_hour) {
            return back()->with('error', 'opening_hour & closing_hour not correct');
        }
        $restaurant->update([
            'address' => $request->address,
            'opening_hour' => $request->opening_hour,
            'closing_hour' => $request->closing_hour
        ]);
        return redirect()->route('setting.edit')->with('success', 'Resturant Infromations Updated Successfully');
    }
}
