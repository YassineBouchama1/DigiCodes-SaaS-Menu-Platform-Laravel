<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;

        // 2-Fetch subscriptions for the authenticated user
        $subscription = Subscription::where('restaurant_id', $restaurantId)
            ->where('status', 'active')
            ->first();
        $plans = Plan::all();



        //3 Return the view with the subscriptions data
        return view('restaurant.subscriptions.index', compact('subscription', 'plans'));
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        // Get the authenticated user's restaurant_id
        $restaurantId = Auth::user()->restaurant_id;

        // Disable old subscriptions for the restaurant
        Subscription::where('restaurant_id', $restaurantId)
            ->where('status', 'active')
            ->update(['status' => 'disable']);


        //check if plan exist
        $selectedPlan = Plan::find($request->plan_id);

        if ($selectedPlan) {



            $requestData = array_merge($request->all(), [
                'restaurant_id' => $restaurantId,
                'start_date' => now(), // starting from now
                // end date is now plus plan duration
                'end_date' => now()->addDays($selectedPlan->duration),
                'status' => 'active',
            ]);

            // Create a new subscription
            Subscription::create($requestData);

            // Redirect back with a success message
            return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully.');
        } else {
            // return error if selected plan not exist
            return redirect()->back()->with('error', 'Selected plan does not exist.');
        }
    }
}
