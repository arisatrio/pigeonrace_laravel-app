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
        $race = Race::with('pos' , 'join')->where('status', 'AKTIF')->where('status', 'SELESAI')->latest()->first();
        if($race){
            $userLoc = [];
            $posLoc = [];
            foreach ($race->join as $key => $item){
                $userLoc[$key] = [
                    $item->name, 
                    -Helper::DDMtoDD($item->latitude), 
                    Helper::DDMtoDD($item->longitude),
                ];
            }
            foreach($race->pos as $key => $item){
                $posLoc[$key] = [$item->city, -Helper::DDMtoDD($item->latitude), Helper::DDMtoDD($item->longitude), $item->no_pos];
            }
            
            $basketing = RacePos::query()
                ->where('race_id', $race->id)
                ->leftJoin('race_basketings as bskt', 'race_pos.id', '=', 'bskt.race_pos_id')
                ->groupBy('bskt.burung_id')
                ->get();

            return view('admin.dashboard', compact('race', 'basketing', 'userLoc', 'posLoc'));
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
