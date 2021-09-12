<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\Burung;
use App\Models\Race;
use App\Models\RacePos;
use App\Models\ClockModel;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $race = Race::where('status', 'AKTIF')->orderBy('tgl_race', 'DESC')->get();

        return view('user.race', compact('race'));
    }

    public function show($slug)
    {
        $race = Race::with(['pos' => function ($q) {
            $q->orderBy('race_pos.no_pos', 'ASC');
        }])->where('slug', $slug)->first();
        return view('user.race-show', compact('race'));
    }

    public function indexRiwayat()
    {
        $race = Race::whereHas('join', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();

        return view('user.riwayat', compact('race'));
    }

    public function riwayatPos($id)
    {
        $race = Race::with(['pos' => function ($q) {
            $q->orderBy('race_pos.no_pos', 'ASC');
        }])->find($id);

        return view('user.riwayat-pos', compact('race'));
    }

    public function posRank($id)
    {
        $pos = RacePos::with('clock')->find($id);
        $rank = $pos->clock()->orderBy('race_clocks.velocity', 'DESC')->get();

        return view('user.riwayat-pos-rank', compact('pos', 'rank'));
    }

    public function totalPos($race_id)
    {
        $race = Race::find($race_id);
        $kelas = $race->kelas->first();
        $clock = Burung::with('user', 'club')
        ->whereHas('clockModel', function ($q) use($race_id){
            $q->where('race_id', $race_id)->where('status', 'SAH');
        })
        ->get();
        
        return view('user.riwayat-total-pos', compact('clock', 'race', 'kelas'));
    }

    public function totalPosKelas($race_id, $kelas_id)
    {
        $race = Race::find($race_id);
        $kelas = $race->kelas->find($kelas_id);
        $clock = Burung::with('user', 'club')
        ->whereHas('clockModel', function ($q) use($race_id){
            $q->where('race_id', $race_id)->where('status', 'SAH');
        })
        ->get();
        
        return view('user.riwayat-total-pos', compact('clock', 'race', 'kelas'));
    }

    public function totalPosDetail($race_id, $burung_id)
    {
        $race = Race::find($race_id);
        $burung = Burung::with(['clockModel' => function ($q) use($race_id) {
            $q->with('pos')->where('race_id', $race_id);
        }, 'user', 'club'])->find($burung_id);

        return view('user.riwayat-total-pos-detail', compact('race', 'burung'));
    }

    public function joinRace($race_id)
    {
        $race = Race::find($race_id);
        $user = auth()->user();

        if (!$race->join->contains($user)) {
            $race->join()->attach($user, ['status' => 1]);
        }

        return redirect()->route('user.home')->with('messages', 'Anda telah mengikuti race');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
