<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuItemController extends Controller
{
    public function index()
    {
        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;

        //2- Fetch menus associated with the authenticated user
        $menuItems = MenuItem::where('restaurant_id', $restaurantId)->get();
        // dd($menus);
        //3- send it to view
        return view('restaurant.menuitems.index', compact('menuItems'));
    }

    public function create()
    {
        return view('restaurant.menuitems.create');
    }




    // Store a newly created menu in storage
    public function store(Request $request)
    {

        dd(MenuItem::find(1)->get()->media);
        // dd($request->image);
        $request->validate([
            'title' => 'required|string|max:255',
            'menu_id' => 'required',
            'description' => 'required|max:255',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);


        $menu = new MenuItem();
        $menu->title = $request->title;
        $menu->menu_id = $request->menu_id;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->restaurant_id = Auth::user()->restaurant_id;
        $menu->save();
        $menu->media()->create(['type' => 'image', 'url' => $imageName]);
        return redirect()->route('menuitems.index')->with('success', 'Menu created successfully.');
    }




    // Display the specified menu
    public function show(MenuItem $menu)
    {
        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;
        if ($menu->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('restaurant.menuitems.show', compact('menu'));
    }

    // Show the form for editing the specified menu
    public function edit(MenuItem $menu)
    {
        if ($menu->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('menuitems.edit', compact('menu'));
    }



    // Update the specified menu in storage
    public function update(Request $request, MenuItem $menu)
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

        return redirect()->route('restaurant.menuitems.index')->with('success', 'Menu updated successfully.');
    }




    // Remove the specified menu from storage
    public function destroy(MenuItem $menu)
    {
        if ($menu->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        $menu->delete();

        return redirect()->route('restaurant.menuitems.index')->with('success', 'Menu deleted successfully.');
    }
}
