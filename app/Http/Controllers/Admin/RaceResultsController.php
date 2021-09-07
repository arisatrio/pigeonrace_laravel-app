<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use DB;

use App\Models\User;
use App\Models\Burung;
use App\Models\Race;
use App\Models\RaceKelas;
use App\Models\RacePos;

class RaceResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $race = Race::where('status', 'AKTIF')->orderBy('tgl_race', 'DESC')->get();

        return view('admin.race-results.index', compact('race'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $race = Race::with(['pos', 'join'])->find($id);

        return view('admin.race-results.show', compact('race'));
    }

    public function cekMap($user_id)
    {
        $user = User::find($user_id);

        return view('admin.race-results.cek-map', compact('user'));
    }

    public function basketing($race_id, $id)
    {
        $race = Race::with('pos')->find($race_id);
        $pos = RacePos::with(['basketing' => function ($q) {
            $q->with(['user', 'club'])->groupBy('race_basketings.burung_id');
        }])->find($id);

        return view('admin.race-results.basketing', compact('race','pos'));
    }

    public function pos($race_id, $id)
    {
        $race = Race::with(['pos' => function ($q) use($id) {
            $q->where('race_pos.id', $id)->first();
        }])->find($race_id);
        $pos = RacePos::with(['clock', 'basketingKelas'])->find($id);
        $validated = $pos->clock()->where('race_clocks.status', null)->count();

        return view('admin.race-results.pos', compact('race', 'pos', 'validated'));
    }

    public function posValidasiPost($id, $pos_id, Request $request)
    {
        $pos = RacePos::with('clock')->find($pos_id);
        $burung = Burung::find($id);

        $pos->clock()->updateExistingPivot($burung, ['status' => $request->status]);

        return redirect()->back()->with('messages', 'Status Clock telah diperbaharui.');
    }

    public function posKelas($race_id, $id, $kelas_id)
    {
        $kelas = RaceKelas::find($kelas_id);
        $pos = RacePos::with('clock')->find($id);
        $rank = $pos->query()
            ->leftJoin('race_clocks as clock', 'race_pos.id', '=', 'clock.race_pos_id')
            ->leftJoin('burungs as burung', 'burung.id', '=', 'clock.burung_id')
			->leftJoin('clubs as club', 'burung.club_id', '=', 'club.id')
            ->leftJoin('users as user', 'user.id', '=', 'burung.user_id')
            ->leftJoin('race_basketings as basketing', 'race_pos.id', '=', 'basketing.race_pos_id')
            ->leftJoin('race_kelas as kelas', 'basketing.race_kelas_id', '=', 'kelas.id')
            ->select('user.name', 'user.city', 'club.nama_club', 'burung.no_ring', 'burung.warna', 'burung.jenkel', 'clock.distance', DB::raw('DATE_FORMAT(clock.arrival_date, "%d/%m/%Y") as arrival_date'), 'clock.arrival_day', DB::raw('DATE_FORMAT(clock.arrival_clock, "%H:%i:%s") as arrival_clock'), 'clock.flying_time', 'clock.velocity')
            ->where('kelas.id', $kelas_id)
            ->where('clock.status', 'SAH')->orderBy('clock.velocity', 'DESC')->get();

        return view('admin.race-results.pos-kelas', compact('pos', 'kelas', 'rank'));
    }

    public function totalPos($race_id)
    {
        $race = Race::with('pos', 'join')->find($race_id);
        $pos = $race->pos()->get();
        $totalPos = $pos->count();
        $coll = Burung::with(['clock', 'club', 'user'])->get();

        return view('admin.race-results.total-pos', compact('race', 'pos', 'totalPos', 'coll'));
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
