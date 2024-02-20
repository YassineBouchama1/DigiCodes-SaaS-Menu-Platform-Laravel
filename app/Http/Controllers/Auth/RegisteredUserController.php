<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        //2- create account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        //3- Assign  Resturant Owner Role if regetser as as resturant owner
        if ($request->has('is_restaurant_owner')) {
            $restaurantOwnerRole = Role::findByName('restaurant owner');
            $user->assignRole($restaurantOwnerRole);
        }

        //3- Assign operator Role if regetser as as operator
        if ($request->has('is_operator')) {
            $operatorRole = Role::findByName('operator');
            $user->assignRole($operatorRole);
        }

        //3- Assign  Resturant Owner Role if regetser as as resturant owner
        if ($request->has('is_restaurant_owner')) {
            $restaurantOwnerRole = Role::findByName('restaurant owner');
            $user->assignRole($restaurantOwnerRole);
        }

        //3- Assign operator Role if regetser as as operator
        if ($request->has('is_admin')) {
            $operatorRole = Role::findByName('admin');
            $user->assignRole($operatorRole);
        }

        //4- Redirect path after registration : to edit it depand which role we create with it
        $redirectPath = RouteServiceProvider::LOGIN; // by defualt sent us to home

        //5- if We create Account for operators
        if ($request->has('is_operator')) {

            $redirectPath = route('operatores.index'); // send to Route list of operators
        }

        // if resturant owner register firt time send him to login page
        // $redirectPath = route('operator.login');



        event(new Registered($user));

        // Auth::login($user);

        return redirect($redirectPath);




        // return redirect(RouteServiceProvider::HOME);
    }
}
