<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Restaurant;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class SocialiteController extends Controller
{

    protected $providers = ["google", "github", "facebook"];

    public function redirect(Request $request)
    {
        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
    }

    public function callback(Request $request)
    {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {

            $data = Socialite::driver($request->provider)->user();
            $user = $data->user;

            $userExist = User::where('social_id', $user['id'])->first();
            if ($userExist) {
                Auth::login($userExist);
                return redirect()->route('restaurant.dashboard');
            } else {

                // create resturant
                $resturantCreated =      Restaurant::create([
                    'name' => $user['name']
                ]);
                // create resturant Statistic
                $resturantStatistic =      Statistic::create([
                    'restaurant_id' => $resturantCreated->id
                ]);

                // assign plan free atomaticly for resturant
                $freePlan = Plan::where('name', 'Free')->first();
                if ($freePlan) {
                    $resturantCreated->subscriptions()->create([
                        'plan_id' => $freePlan->id,
                        'start_date' => now(), // starting fron now
                        //end from now plus furation days comes from plans 30days
                        'end_date' => now()->addDays($freePlan->duration),
                        'status' => 'active',
                    ]);
                }

                $newUser = User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['id']),
                    'social_id' => $user['id'],
                    'social_type' => $request->provider,
                    'restaurant_id' => $resturantCreated->id
                ]);

                $restaurantOwnerRole = Role::findByName('restaurant owner');
                $newUser->assignRole($restaurantOwnerRole);

                Auth::login($newUser);
                return redirect()->route('restaurant.dashboard');
            }
        }
        abort(404);
    }
}
