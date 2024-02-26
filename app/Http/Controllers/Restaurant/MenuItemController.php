<?php

namespace App\Http\Controllers\Restaurant;

use App\Events\RestaurantLogsEvent;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class MenuItemController extends Controller
{
    public function index()
    {
        // dd(MenuItem::find(1)->media);

        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;

        //2- Fetch menus associated with the authenticated user
        $menuItems = MenuItem::where('restaurant_id', $restaurantId)->get();
        // dd($menuItems[0]->media);
        //3- send it to view
        return view('restaurant.menuitems.index', compact('menuItems'));
    }

    public function create()
    {
        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;

        //2- Fetch menus associated with the authenticated user
        $menus = Menu::where('restaurant_id', $restaurantId)->get();
        return view('restaurant.menuitems.create', compact('menus'));
    }




    // Store a newly created menu in storage
    public function store(Request $request)
    {


        // dd($request->image);
        $request->validate([
            'title' => 'required|string|max:255',
            'menu_id' => 'required',
            'description' => 'required|max:255',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'nullable|file'
        ]);

        $image = $request->file('image');
        $video = $request->file('video');

        // $imageName = time() . '.' . $request->image->extension();

        // $request->image->move(public_path('images'), $imageName);


        $menu = new MenuItem();
        $menu->title = $request->title;
        $menu->menu_id = $request->menu_id;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->restaurant_id = Auth::user()->restaurant_id;
        $menu->save();
        if ($image) {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $menu->media()->create(['type' => 'image', 'url' => $imageName]);
        }

        if ($video) {
            $videoName = time() . '.' . $video->extension();
            $video->move(public_path('videos'), $videoName);
            $menu->media()->create(['type' => 'video', 'url' => $videoName]);
        }

        //get owner of this resturnat
        $ownerRestaurant = User::role('restaurant owner')
            ->where('restaurant_id', $menu->restaurant_id)
            ->first();
        // dd($ownerRestaurant);
        // send email to resturnat owner
        Event::dispatch(new RestaurantLogsEvent(Auth::user(), 'create Menu Item', $ownerRestaurant));

        return redirect()->route('menuitems.index')->with('success', 'Menu created successfully.');
    }




    // Display the specified menu
    public function show(MenuItem $menuitem)
    {
        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;
        if ($menuitem->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('restaurant.menuitems.show', compact('menuitem'));
    }

    // Show the form for editing the specified menu
    public function edit(MenuItem $menuitem)
    {
        if ($menuitem->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('restaurant.menuitems.edit', compact('menuitem'));
    }



    // Update the specified menu in storage
    public function update(Request $request, MenuItem $menuitem)
    {
        if ($menuitem->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        $menuitem->fill($request->only([
            'title',
            'menu_id',
            'description',
            'price',
        ]));


        if ($request->hasFile('image')) {

            $oldImage = $menuitem->media()->where('type', 'image')->first();
            if ($oldImage) {
                $oldImagePath = public_path('images/' . $oldImage->url);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $oldImage->delete();
            }

            // Upload new image
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('images'), $imageName);

            // Create new media record for the menu item
            $menuitem->media()->create(['type' => 'image', 'url' => $imageName]);
        }

        $menuitem->save();
        //get owner of this resturnat
        $ownerRestaurant = User::role('restaurant owner')
            ->where('restaurant_id', $menuitem->restaurant_id)
            ->first();
        // dd($ownerRestaurant);
        // send email to resturnat owner
        Event::dispatch(new RestaurantLogsEvent(Auth::user(), 'Update Menu Item', $ownerRestaurant));

        return redirect()->route('menuitems.index')->with('success', 'Menu updated successfully.');
    }




    // Remove the specified menu from storage
    public function destroy(MenuItem $menuitem)
    {
        if ($menuitem->restaurant_id !== Auth::user()->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }
        $restaurant_id = $menuitem->restaurant_id;
        $menuitem->delete();
        //get owner of this resturnat
        $ownerRestaurant = User::role('restaurant owner')
            ->where('restaurant_id', $restaurant_id)
            ->first();
        // dd($ownerRestaurant);
        // send email to resturnat owner
        Event::dispatch(new RestaurantLogsEvent(Auth::user(), 'Deleted Category', $ownerRestaurant));

        return redirect()->route('menuitems.index')->with('success', 'Menu deleted successfully.');
    }
}
