<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Burung;
use App\Models\Race;
use App\Models\RaceKelas;
use App\Models\RacePos;

class HasilRaceController extends Controller
{
    public function index()
    {
        $race = Race::where('status', 'AKTIF')->orWhere('status', 'SELESAI')->orderBy('tgl_race', 'DESC')->get();

        return view('welcome', compact('race'));
    }

    public function show($id)
    {
        $race = Race::with(['pos', 'join'])->find($id);

        return view('race-result', compact('race'));
    }

    public function basketing($race_id, $id)
    {
        $race = Race::with('pos')->find($race_id);
        $pos = RacePos::with(['basketing' => function ($q) {
            $q->with(['user', 'club'])->groupBy('race_basketings.burung_id');
        }])->find($id);
        return view('basketing', compact('race','pos'));
    }

    public function pos($race_id, $id)
    {
        $race = Race::with(['pos' => function ($q) use($id) {
            $q->where('race_pos.id', $id)->first();
        }])->find($race_id);
        $pos = RacePos::with(['clock', 'basketingKelas'])->find($id);
        $validated = $pos->clock()->where('race_clocks.status', null)->count();

        return view('pos', compact('race', 'pos', 'validated'));
    }

    public function posKelas($race_id, $id, $kelas_id)
    {
        $kelas = RaceKelas::find($kelas_id);
        $pos = RacePos::with('clock')->find($id);
        $rank = $pos->clock()->where('race_clocks.race_kelas_id', $kelas_id)->where('race_clocks.status', 'SAH')->orderBy('race_clocks.velocity', 'DESC')->get();

        return view('pos-kelas', compact('pos', 'kelas', 'rank'));
    }

    public function totalPos($race_id)
    {
        $race = Race::with('pos', 'join')->find($race_id);
        $pos = $race->pos()->get();
        $totalPos = $pos->count();
        $coll = Burung::with(['clock', 'club', 'user'])->get();


        return view('total-pos', compact('race', 'pos', 'totalPos', 'coll'));
    }

}
