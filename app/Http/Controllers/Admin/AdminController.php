<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function dashboard()
    {

        $Restaurant = Restaurant::get();
        $Users = User::get();
        $data = User::selectRaw("to_char(created_at, 'YYYY-MM-DD') as date, count(*) as aggregate")
            ->where('created_at', '>=', now()->subDays(30)->startOfDay())
            ->groupBy('date')
            ->get();

        return view('admin.dashboard', compact('Restaurant', 'Users', 'data'));
    }
}
