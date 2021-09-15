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

class UserHomeController extends Controller
{
    public function home()
    {
        $race = Race::where('status', 'AKTIF')->whereDoesntHave('join', function ($query){
            $query->where('user_id', auth()->user()->id);
        })->get();

        $raceJoined = Race::where('status', 'AKTIF')->whereHas('join', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();

        return view('user.home', compact('race', 'raceJoined'));
    }

    public function raceMode($id)
    {
        $race = Race::with(['pos' => function($q) {
            $q->orderBy('no_pos', 'ASC');
        }])->find($id);
    
        return view('user.home-race-mode', compact('race'));
    }

    public function posMode($id)
    {
        $pos = RacePos::with([
            'basketing' => function ($q) use ($id) {
                $q->with(['user', 'club', 'basketingKelas' => function ($q) use($id) {
                    $q->where('race_pos_id', $id);
                }])->where('user_id', auth()->user()->id)->where('race_pos_id', $id)->groupBy('id');
            }
        ])->find($id);

        $burungClock = $pos->basketing()
            ->where('user_id', auth()->user()->id)
            ->whereDoesntHave('clock', function ($q) use($id) {
                $q->where('race_pos_id', $id);
            })->get();

        // Helper VAR
        $now = Carbon::now();
        $jarak = Helper::calculateDistance(auth()->user()->latitude, auth()->user()->longitude, $pos->latitude, $pos->longitude);
        $userLoc = [-Helper::DDMtoDD(auth()->user()->latitude), Helper::DDMtoDD(auth()->user()->longitude)];
        $posLoc = [-Helper::DDMtoDD($pos->latitude), Helper::DDMtoDD($pos->longitude)];
        
        return view('user.home-race-pos', compact('pos', 'burungClock', 'now', 'jarak', 'userLoc', 'posLoc'));
    }

    public function stopJoin($race_id)
    {
        $race = Race::find($race_id);
        $user = auth()->user();

        $race->join()->detach($user);

        return redirect()->route('user.home')->with('messages', 'Anda telah berhenti mengikuti Race !.');
    }

    public function basketingStore($race_pos_id, Request $request)
    {
        $this->validate($request, [
            'burung_id' => 'required',
            'kelas_id'  => 'required',
        ]);
        $input = $request->only(['burung_id', 'kelas_id']);
        $pos = RacePos::find($race_pos_id);
        $burung = Burung::with('basketing')->find($request->burung_id);
        
        if($burung->basketing->contains($race_pos_id) && $burung->basketingKelas->contains($request->kelas_id)){
            return redirect()->back()->withErrors(['error' => 'Burung sudah dalam kelas Basketing!']);
        }
        $pos->basketing()->attach($request->burung_id, ['race_kelas_id' => $request->kelas_id]);
        
        return redirect()->back()->with('messages', 'Burung telah ditambahkan ke dalam Basketing');
    }

    public function clockStore($race_pos_id, Request $request)
    {
        $now = Carbon::now();
        $user = auth()->user();
        $pos = RacePos::find($race_pos_id);
        $burung = Burung::find($request->burung_id);
        $distance = Helper::calculateDistance($user->latitude, $user->longitude, $pos->latitude, $pos->longitude);
        $flying_time = $request->flying_time;
        $velocity = Helper::calculateVelocity($distance, $request->fly);
        $no_stiker = $request->no_stiker;
        $kelas = $burung->basketingKelas()->first();
        
        $pos->clock()->attach($burung, [
            'distance'      => $distance,
            'arrival_date'  => $now->format('d-m-Y'),
            'arrival_day'   => $pos->tgl_lepasan->diffInDays($now),
            'arrival_clock' => $now->format('H:i:s'),
            'flying_time'   => $flying_time,
            'velocity'      => $velocity,
            'no_stiker'     => $request->no_stiker,
            'race_kelas_id' => $kelas->id,
            'race_id'       => $pos->race->id,
        ]);

        return redirect()->back()->with('messages', 'Clock telah dikirim');
    }
}
