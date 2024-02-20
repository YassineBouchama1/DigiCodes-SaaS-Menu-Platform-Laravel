<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{


    public function index()
    {
        // Retrieve all plans
        $plans = Plan::all();


        // Return view with plans data
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        // Return the view for creating a new plan
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_menu_items' => 'required|integer',
            'max_media' => 'required|integer',
            'max_scans' => 'required|integer',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        // Create a new plan instance
        $plan = new Plan();
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->max_menu_items = $request->max_menu_items;
        $plan->max_media = $request->max_media;
        $plan->max_scans = $request->max_scans;
        $plan->price = $request->price;
        $plan->duration = $request->duration;
        $plan->save();

        // Redirect to the index page with success message
        return redirect()->route('plans.index')->with('success', 'Plan created successfully.');
    }




    public function show(Plan $plan)
    {
        // Return the view for displaying a specific plan
        return view('admin.plans.show', compact('plan'));
    }



    public function edit(Plan $plan)
    {
        // Return the view for editing a specific plan
        return view('admin.plans.edit', compact('plan'));
    }



    public function update(Request $request, Plan $plan)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_menu_items' => 'required|integer',
            'max_media' => 'required|integer',
            'max_scans' => 'required|integer',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        // Update the plan instance
        $plan->update([
            'name' => $request->name,
            'description' => $request->description,
            'max_menu_items' => $request->max_menu_items,
            'max_media' => $request->max_media,
            'max_scans' => $request->max_scans,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        // Redirect back to the index page with success message
        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }



    public function destroy(Plan $plan)
    {
        // Delete the plan instance
        $plan->delete();

        // Redirect back to the index page with success message
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
    }
}
