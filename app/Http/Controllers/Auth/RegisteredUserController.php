<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Restaurant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        //1- validation inputs
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nameResturant' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);




        // if resgisterd as resturant owner
        if ($request->has('is_restaurant_owner')) {

            // if register as resturant onwer valid if they enter name resturant
            $request->validate([
                'nameResturant' => ['required', 'string', 'max:255'],
            ]);

            // create resturant
            $resturantCreated =      Restaurant::create([
                'name' => $request->nameResturant
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

            //create account for  resturnat
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'restaurant_id' => $resturantCreated->id
            ]);

            //assign resturant owner role
            $restaurantOwnerRole = Role::findByName('restaurant owner');
            $user->assignRole($restaurantOwnerRole);
        }









        //4- Redirect path after registration : to edit it depand which role we create with it
        $redirectPath = RouteServiceProvider::LOGIN; // by defualt sent us to home




        event(new Registered($user));

        // Auth::login($user);

        return redirect($redirectPath);
    }



    public function formAdmin(): View
    {
        return view('auth.createAdmin');
    }

    public function createAdmin(Request $request)
    {


        //1- fill data for admin
     

        //2- validation inputs
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);




        //3- create account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //4- assign role and permissions
        $operatorRole = Role::findByName('admin');
        $user->assignRole($operatorRole);








        event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Admin account created successfully.');
    }
}
