<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use DB;

use App\Models\Burung;
use App\Models\Race;
use App\Models\RaceKelas;
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

    public function basketingPos($id)
    {
        $pos = RacePos::with(['basketing' => function ($q) {
            $q->with(['user', 'club'])->groupBy('burung_id')->orderBy('user_id');
        }])->find($id);

        return view('user.riwayat-basketing-pos', compact('pos'));
    }

    public function basketingKelas($id, $kelas_id)
    {
        $kelas = RaceKelas::find($kelas_id);
        $pos = RacePos::with(['basketing' => function ($q) use($kelas) {
            $q->with(['user', 'club'])->where('race_kelas_id', $kelas->id)->groupBy('burung_id')->orderBy('user_id');
        }])->find($id);

        return view('user.riwayat-basketing-kelas', compact('pos', 'kelas'));
    }

    public function posRank($id)
    {
        $kelas = RaceKelas::first();
        $pos = RacePos::with(['clock' => function ($q) use($kelas) {
            $q->with('user', 'club')->where('race_kelas_id', $kelas->id)->where('status', '!=', 'TIDAK SAH')->orWhereNull('status')->orderByDesc('velocity');
        }])->find($id);

        return view('user.riwayat-pos-rank', compact('pos', 'kelas'));
    }

    public function posKelasRank($id, $kelas_id)
    {
        $kelas = RaceKelas::find($kelas_id);
        $pos = RacePos::with(['clock' => function ($q) use($kelas) {
            $q->with('user', 'club')->where('race_kelas_id', $kelas->id)->where('status', '!=', 'TIDAK SAH')->orWhereNull('status')->orderByDesc('velocity');
        }])->find($id);

        return view('user.riwayat-pos-rank', compact('pos', 'kelas'));
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
}
