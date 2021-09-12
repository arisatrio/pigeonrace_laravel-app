<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\User;
use App\Models\Race;
use App\Models\RacePos;

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
            $userLoc = [];
            foreach ($race->join as $key => $item){
                $userLoc[$key] = [$item->name, -Helper::DDMtoDD($item->latitude), Helper::DDMtoDD($item->longitude)];
            }

            return view('admin.dashboard', compact('race', 'userLoc'));
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
