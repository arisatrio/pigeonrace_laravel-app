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
            $races          = Race::with('pos', 'join')->where('status', '!=', 'PENDING');
            $allRace        = $races->orderBy('created_at', 'DESC')->get();
            $selectedRace   = $races->latest()->first();
            
            $userLoc = $this->collectUserLoc($selectedRace->join);
            $posLoc = $this->collectPosLoc($selectedRace->pos);
            
            $basketing = RacePos::query()->where('race_id', $selectedRace->id)->leftJoin('race_basketings as bskt', 'race_pos.id', '=', 'bskt.race_pos_id')->groupBy('bskt.burung_id')->get();

            return view('admin.dashboard', compact('allRace', 'selectedRace', 'basketing', 'userLoc', 'posLoc'));
    }

    public function adminReq($slug)
    {
        $races          = Race::with('pos', 'join')->where('status', '!=', 'PENDING');
        $allRace        = $races->orderBy('created_at', 'DESC')->get();
        $selectedRace   = $races->where('slug', $slug)->first();

        $userLoc = $this->collectUserLoc($selectedRace->join);
        $posLoc = $this->collectPosLoc($selectedRace->pos);

        $basketing = RacePos::query()->where('race_id', $selectedRace->id)->leftJoin('race_basketings as bskt', 'race_pos.id', '=', 'bskt.race_pos_id')->groupBy('bskt.burung_id')->get();

        return view('admin.dashboard', compact('allRace', 'selectedRace', 'basketing', 'userLoc', 'posLoc'));
    }

    public function collectUserLoc($obj)
    {
        $userLoc = [];
        foreach ($obj as $key => $item){
            $userLoc[$key] = [
                $item->name, 
                -Helper::DDMtoDD($item->latitude), 
                Helper::DDMtoDD($item->longitude),
            ];
        }

        return $userLoc;
    }

    public function collectPosLoc($obj)
    {
        $posLoc = [];
        foreach($obj as $key => $item){
            $posLoc[$key] = [$item->city, -Helper::DDMtoDD($item->latitude), Helper::DDMtoDD($item->longitude), $item->no_pos];
        }

        return $posLoc;
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
