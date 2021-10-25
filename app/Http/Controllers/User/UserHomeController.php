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
    
    public function joinRace($race_id)
    {
        $race = Race::find($race_id);
        $user = auth()->user();

        if (!$race->join->contains($user)) {
            $race->join()->attach($user, ['status' => 1]);
        }

        return redirect()->route('user.home')->with('messages', 'Anda telah mengikuti race');
    }

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
        $pos = RacePos::find($id);
        $user = auth()->user();
        $burung = $user->burung()->with('club');

        $burungBasketing = $burung
            ->whereHas('basketing', function ($q) use($user, $pos) {
                $q->where('race_pos_id', $pos->id);
            })
            ->with(['basketingKelas' => function ($q) use($pos) {
                $q->where('race_pos_id', $pos->id);
            }])
            ->get();

        $burungClock = $burung
            ->whereHas('basketing', function ($q) use($pos) {
                $q->where('race_pos_id', $pos->id);
            })->get();

        // Helper VAR
        $now = Carbon::now();
        $jarak = Helper::calculateDistance(auth()->user()->latitude, auth()->user()->longitude, $pos->latitude, $pos->longitude);
        $userLoc = [-Helper::DDMtoDD(auth()->user()->latitude), Helper::DDMtoDD(auth()->user()->longitude)];
        $posLoc = [-Helper::DDMtoDD($pos->latitude), Helper::DDMtoDD($pos->longitude)];

        if(!$pos->limit_speed){
            $limit = $pos->tgl_lepasan->addDays($pos->limit_day);
        } else {
            $limit = Helper::limitBySpeed($jarak, $pos->limit_speed, $pos->tgl_lepasan);
        }
        
        return view('user.home-race-pos', compact('pos', 'user', 'burungBasketing', 'burungClock', 'now', 'jarak', 'userLoc', 'posLoc', 'limit'));
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
        $pos = RacePos::find($race_pos_id);
        $burung = Burung::with(['basketingKelas' => function ($q) use($pos) {
            $q->where('race_pos_id', $pos->id);
        }])->find($request->burung_id);

        if($burung->basketingKelas->contains($request->kelas_id)){
            return redirect()->back()->withErrors(['error' => 'Burung sudah dalam kelas Basketing!']);
        } else {
            $pos->basketing()->attach($request->burung_id, ['race_kelas_id' => $request->kelas_id]);
            return redirect()->back()->with('messages', 'Burung telah ditambahkan ke dalam Basketing');
        }
    }

    public function basketingHapus($pos_id, $id)
    {
        $burung = Burung::find($id);
        $pos = RacePos::find($pos_id);

        $burung->basketing()->detach($pos);

        return redirect()->back()->with('messages', 'Data basketing telah dihapus.');
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
        $kelas = $burung->basketingKelas->where('race_id', $pos->race->id)->first();

        //Jika di input setelah masuk close time maka redirect back
        if($pos->limit_speed) {
            if($velocity < $pos->limit_speed){
                return redirect()->back();
            }
        }
        // Jika sudah clock maka update, jika belum maka attach
        if($pos->clock->contains($burung->id) && $pos->clockKelas->contains($kelas->id)) {
            $pos->clock()->updateExistingPivot($burung, [
                'arrival_date'  => $now->format('d-m-Y'),
                'arrival_day'   => $pos->tgl_lepasan->diffInDays($now),
                'arrival_clock' => $now->format('H:i:s'),
                'flying_time'   => $flying_time,
                'velocity'      => $velocity,
                'no_stiker'     => $request->no_stiker,
            ]);
        } else {
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
        }

        return redirect()->back()->with('messages', 'Clock telah dikirim');
    }
}
