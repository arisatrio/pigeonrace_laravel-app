<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Race;

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
        $race = Race::with('pos', 'join')->where('status', 'AKTIF')->latest()->first();
        if($race){
            $latlong = [];
            foreach ($race->join as $item){
                $latlong[] = [$item->name, $item->latitude, $item->longitude];
            }
            return view('admin.dashboard', compact('race', 'latlong'));
        }

        return view('admin.dashboard', compact('race'));
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
