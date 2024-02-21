<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        // Fetch all subscriptions
        $subscriptions = Subscription::all();

        // Return the view with the subscriptions data
        return view('restaurant.subscriptions.index', compact('subscriptions'));
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'plan_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Merge the user_id into the request data
        $requestData = array_merge($request->all(), ['user_id' => $userId]);

        // Create a new subscription
        Subscription::create($requestData);

        // Redirect back with a success message
        return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully.');
    }
}
