<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helper\Helper;

use App\Models\User;
use App\Models\Burung;
use App\Models\Race;
use App\Models\RacePos;
use App\Models\Basketing;

class UserHomeController extends Controller
{
    public function index()
    {
        // INSTANSIASI OBJ


        //$burung = 


       
        $race = Race::where('status', 'AKTIF')->get();

        $user = auth()->user();
        $isUserJoin = $user->join()->whereHas('join', function ($query) use($user) {
            $query->where('user_id', $user->id);
            $query->where('users_join_races.status', 1);
        })->exists();

        $r = $user->join()->whereHas('join', function ($query) use($user) {
            $query->where('user_id', $user->id);
            $query->where('users_join_races.status', 1);
        })->first();

        // if ($r != null){
            
        // }
        // INSTANSIASI OBJ
        //$burung = new Burung;
        $now = Carbon::now();

        if ($isUserJoin != true) {
            $posActive = [];
            $basketing= [];
            $jarak = [];
            $burungClock = [];
            $hasilClock = [];


        } else {
            $posActive = $r->pos()->whereDate('tgl_lepasan', '<=', Carbon::now())->orderBy('tgl_inkorv', 'ASC')->first();

            $jarak = Helper::calculateDistance($user->latitude, $user->longitude, $posActive->latitude, $posActive->longitude);

            $basketing = Burung::whereHas('user', function ($q){
                $q->where('user_id', auth()->user()->id);
            })->whereHas('basketing')->get();

            $burungClock = Burung::whereHas('user', function ($q){
                $q->where('user_id', auth()->user()->id);
            })->whereHas('basketing')->doesntHave('clock')->get();

            $hasilClock = Burung::with('clock')->whereHas('user', function ($q){
                $q->where('user_id', auth()->user()->id);
            })->whereHas('clock')->get();
           
            
        }

        //dd($posActive);

        //dd(Helper::flyingTime($posActive->tgl_lepasan, Carbon::now()));
        // foreach($hasilClock as $item){
        //     foreach($item->clock as $clock){
        //         dd($clock);
        //     }
        // };

        //dd($basketing);
        

        return view('user.home', compact('race', 'isUserJoin', 'r', 'posActive', 'jarak', 'basketing', 'burungClock', 'hasilClock', 'now'));
    }


    public function stopJoin($race_id)
    {
        $race = Race::find($race_id);
        $user = auth()->user();

        $race->join()->detach($user);

        return redirect()->route('user.home')->with('messages', 'Anda telah berhenti mengikuti Race !.');
    }

    public function basketing($id, $race_pos_id)
    {
        $pos = RacePos::find($race_pos_id);
        $burung = Burung::whereHas('user', function ($q){
            $q->where('user_id', auth()->user()->id);
        })->doesntHave('basketing')->get();

        return view('user.basketing-add', compact('burung', 'pos'));
    }

    public function basketingStore($race_pos_id, Request $request)
    {
        $input = $request->input('burung_id');
        $pos = RacePos::find($race_pos_id);
        
        for($i=0; $i<count($input); $i++){
            $pos->basketing()->attach($input[$i]);
        }

        return redirect()->route('user.home')->with('messages', 'Burung telah ditambahkan ke dalam Basketing');
    }

    public function clockStore($race_pos_id, Request $request)
    {
        $now = Carbon::now();
        $user = auth()->user();
        $pos = RacePos::find($race_pos_id);
        $burung = Burung::find($request->burung_id);
        $distance = Helper::calculateDistance($user->latitude, $user->longitude, $pos->latitude, $pos->longitude);
        $flying_time = Helper::flyingTime($pos->tgl_lepasan, $now);
        $velocity = Helper::calculateVelocity($distance, $pos->tgl_lepasan->diffInMinutes($now));
        $no_stiker = $request->no_stiker;
        
        $pos->clock()->attach($burung, [
            'distance'      => $distance,
            'arrival_date'  => $now->format('d-m-Y'),
            'arrival_day'   => $pos->tgl_lepasan->diffInDays($now),
            'arrival_clock' => $now->format('H:i:s'),
            'flying_time'   => $flying_time,
            'velocity'      => $velocity,
            'no_stiker'     => $request->no_stiker
        ]);

        return redirect()->route('user.home')->with('messages', 'Clock telah dikirim');
    }
}
