<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{


    public function create()
    {


        // 1- fetch all users & permissions
        $users = User::all();
        $permissions = Permission::all();

        return view('admin.permissions.create', compact('users', 'permissions'));
    }

    public function store(Request $request)
    {
        //1- validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        //2- get user with his id
        $user = User::findOrFail($request->user_id);

        //3- get all permissions we want add to this user
        $permissions = $request->permissions;

        //4- assign all permissions to user
        $user->syncPermissions($permissions);

        return redirect()->back()->with('success', 'Permissions assigned successfully.');
    }
}
