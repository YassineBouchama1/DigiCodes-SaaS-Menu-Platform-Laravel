<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Auth\Events\Registered;

use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class OperatoreController extends Controller
{
    public function index()
    {

        $operators = User::where('restaurant_id', Auth::user()->restaurant_id)->get();
        // @dd($operators[0]->permissions);
        return view('restaurant.operatores.index', compact('operators'));
    }


    public function create()
    {

        // $permissions = Auth::user()->permissions;

        $permissions = DB::table('permissions')->get();



        return view('restaurant.operatores.create', compact('permissions'));
    }

    public function store(Request $request)
    {


        // Validation inputs
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'permissions' => ['array'],
        ]);




        // Create account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role
        $operatorRole = Role::findByName('operator');
        $user->assignRole($operatorRole);

        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $user->syncPermissions($permissions);
        } else {
            $user->syncPermissions([]);
        }

        event(new Registered($user));

        return redirect()->route('operatores.index')->with('success', 'Operator Created successfully.');
    }


    public function show(User $operatore)
    {
        // Return the view for displaying a specific plan
        return view('admin.plans.show', compact('plan'));
    }

    public function edit(User $operatore)
    {
        $permissions = DB::table('permissions')->get();

        // Return the view for editing a specific operatore
        return view('restaurant.operatores.edit', compact('operatore', 'permissions'));
    }
    public function destroy(User $operatore)
    {
        // Delete the operatore instance
        $operatore->delete();

        // Redirect back to the index page with success message
        return redirect()->route('operatores.index')->with('success', 'operatore deleted successfully.');
    }
}
