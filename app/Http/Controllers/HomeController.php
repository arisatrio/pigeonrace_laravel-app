<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function superAdmin()
    {
        return view('superadmin.dashboard');
    }

    public function user()
    {
        return view('user.home');
    }
}
