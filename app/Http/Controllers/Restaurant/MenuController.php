<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;

        //2- Fetch menus associated with the authenticated user
        $menus = Menu::where('restaurant_id', $restaurantId)->get();
        // dd($menus);
        //3- send it to view
        return view('restaurant.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('restaurant.menus.create');
    }




    // Store a newly created menu in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $menu = new Menu();
        $menu->title = $request->title;
        $menu->description = $request->description;
        $menu->user_id = Auth::id();
        $menu->save();

        return redirect()->route('restaurant.menus.index')->with('success', 'Menu created successfully.');
    }




    // Display the specified menu
    public function show(Menu $menu)
    {
        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;
        if ($menu->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('restaurant.menus.show', compact('menu'));
    }

    // Show the form for editing the specified menu
    public function edit(Menu $menu)
    {
        if ($menu->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('menus.edit', compact('menu'));
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
        if ($menu->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        $menu->delete();

        return redirect()->route('restaurant.menus.index')->with('success', 'Menu deleted successfully.');
    }
}
