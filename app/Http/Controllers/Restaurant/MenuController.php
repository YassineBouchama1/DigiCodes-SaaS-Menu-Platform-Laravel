<?php

namespace App\Http\Controllers\Restaurant;

use App\Events\RestaurantLogsEvent;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Menu $menu)
    {

        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;

        //2- Fetch menus associated with the authenticated user
        $menus = Menu::where('restaurant_id', $restaurantId)->get();
        // dd($menus);
        //3- send it to view
        return view('restaurant.menus.index', compact('menus', 'menu'));
    }






    // Store a newly created menu in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $restaurantId = Auth::user()->restaurant_id;
        $menu = new Menu();
        $menu->title = $request->title;
        $menu->description = $request->description;
        $menu->restaurant_id = $restaurantId;
        $menu->save();


        //get owner of this resturnat
        $ownerRestaurant = User::role('restaurant owner')
            ->where('restaurant_id', $restaurantId)
            ->first();
        // dd($ownerRestaurant);
        // send email to resturnat owner
        Event::dispatch(new RestaurantLogsEvent(Auth::user(), 'create Category', $ownerRestaurant));

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }




    // Display the specified menu
    public function show(Menu $menu)
    {
        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;
        if ($menu->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('restaurant.menus.index', compact('menu'));
    }




    // Update the specified menu in storage
    public function update(Request $request, Menu $menu)
    {
        if ($menu->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $menu->title = $request->title;
        $menu->description = $request->description;
        $menu->save();

        return redirect()->route('restaurant.menus.index')->with('success', 'Menu updated successfully.');
    }




    // Remove the specified menu from storage
    public function destroy(Menu $menu)
    {
        //get owner of this resturnat
        $ownerRestaurant = User::role('restaurant owner')
            ->where('restaurant_id', $menu->restaurant_id)
            ->first();
        // dd($ownerRestaurant);
        // send email to resturnat owner
        Event::dispatch(new RestaurantLogsEvent(Auth::user(), 'Deleted Category', $ownerRestaurant));

        if ($menu->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
