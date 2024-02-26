<?php

namespace App\Http\Controllers\Admin;

use App\Events\OperatorMail;
use Illuminate\Auth\Events\Registered;

use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Spatie\Permission\Models\Role;


class UsersController extends Controller
{
    public function index()
    {

        $users = User::role('user')
            ->get();

        return view('admin.users.index', compact('users'));
    }


    public function create()
    {

        // $permissions = Auth::user()->permissions;

        $permissions = DB::table('permissions')->get();



        return view('admin.users.create', compact('permissions'));
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
            'restaurant_id' => Auth::user()->restaurant_id,
        ]);

        // Assign role
        $userRole = Role::findByName('user');
        $user->assignRole($userRole);


        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $user->syncPermissions($permissions);
        } else {
            $user->syncPermissions([]);
        }

        event(new Registered($user));
        Event::dispatch(new OperatorMail($user, 'create', $request->password));
        return redirect()->route('users.index')->with('success', 'user Created successfully.');
    }




    public function edit(User $user)
    {
        $permissions = DB::table('permissions')->get();

        // Return the view for editing a specific operatore
        return view('admin.users.edit', compact('user', 'permissions'));
    }


    public function update(Request $request, User $user)
    {
        // Validation inputs
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'permissions' => ['array'],
        ]);


        // $operatore = User::findOrFail($id);

        // Update name and password if provided
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Revoke all existing permissions
        // $operatore->revokeAllPermissions();

        // Assign new permissions
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $user->syncPermissions($permissions);
        } else {
            $user->syncPermissions([]);
        }

        Event::dispatch(new OperatorMail($user, 'update'));
        return   back()->with('success', 'user updated successfully.');
    }





    public function destroy(User $user)
    {
        // Delete the operatore instance
        $user->delete();
        // Event::dispatch(new OperatorMail($operatore, 'Delete'));

        // Redirect back to the index page with success message
        return redirect()->route('users.index')->with('success', 'user deleted successfully.');
    }
}
