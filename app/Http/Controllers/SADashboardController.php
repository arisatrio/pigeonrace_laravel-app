<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class SADashboardController extends Controller
{
    public function index()
    {
        $admin = User::where('role_id', 2)->count();
        $user = User::where('role_id', 3)->count();

        return view('super-admin.dashboard', compact('user', 'admin'));
    }
}
