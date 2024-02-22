<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Auth\Events\Registered;

use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class OperatoreController extends Controller
{
    public function index()
    {

        return view('restaurant.operatores.index');
    }
    public function create()
    {
        // Return the view for creating a new plan
        return view('restaurant.operatores.create');
    }

    public function store(Request $request)
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



        $operatorRole = Role::findByName('operator');
        $user->assignRole($operatorRole);





        event(new Registered($user));

        return redirect()->route('operatores.index')->with('success', 'Operator Created successfully.');
    }
}
