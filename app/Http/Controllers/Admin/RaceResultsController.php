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
        $race = Race::where('status', 'AKTIF')->orWhere('status', 'SELESAI')->orderBy('tgl_race', 'DESC')->get();

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
        $race = Race::with(['pos' => function ($q) {
            $q->orderBy('race_pos.no_pos');
        }, 'join'])->find($id);

        return view('admin.race-results.show', compact('race'));
    }

    public function cekMap($user_id)
    {
        $user = User::find($user_id);
        $userLoc = [-Helper::DDMtoDD($user->latitude), Helper::DDMtoDD($user->longitude)];

        return view('admin.race-results.cek-map', compact('user', 'userLoc'));
    }

    public function basketing($race_id, $id)
    {
        $race   = Race::with('pos')->find($race_id);
        $kelas  = $race->kelas->first();
        $pos = RacePos::with(['basketing' => function ($q) use($kelas) {
            $q->with(['user', 'club'])->where('race_basketings.race_kelas_id', $kelas->id);
        }])->find($id);

        return view('admin.race-results.basketing', compact('race','pos', 'kelas'));
    }

    public function basketingKelas($race_id, $id, $kelas_id)
    {
        $race   = Race::with('pos')->find($race_id);
        $kelas  = $race->kelas->find($kelas_id);
        $pos = RacePos::with(['basketing' => function ($q) use($kelas) {
            $q->with(['user', 'club'])->where('race_basketings.race_kelas_id', $kelas->id);
        }])->find($id);

        return view('admin.race-results.basketing', compact('race','pos', 'kelas'));
    }

    public function basketingHapus($pos_id, $burung_id)
    {
        $pos = RacePos::find($pos_id);
        $pos->basketing()->detach($burung_id);

        return redirect()->back()->with('messages', 'Data basketing telah dihapus.');
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
        $race = Race::with('kelas')->find($race_id);
        $kelas = $race->kelas->first();
        $basketing = Burung::with(['user', 'club'])
            ->whereHas('basketing', function ($q) use($kelas) {
                $q->where('race_kelas_id', $kelas->id);
            })
            ->whereHas('clockModel', function ($q) use($race_id, $kelas) {
                $q->where('race_id', $race_id)->where('race_kelas_id', $kelas->id);
            })
            ->get();
        $totalPos = $race->pos->count();

        return view('admin.race-results.total-pos', compact('race', 'kelas', 'basketing', 'totalPos'));
    }

    public function totalPosKelas($race_id, $kelas_id)
    {
        $race = Race::with('kelas')->find($race_id);
        $kelas = $race->kelas->find($kelas_id);
        $basketing = Burung::with(['user', 'club'])
            ->whereHas('basketing', function ($q) use($kelas) {
                $q->where('race_kelas_id', $kelas->id);
            })
            ->whereHas('clockModel', function ($q) use($race_id, $kelas) {
                $q->where('race_id', $race_id)->where('race_kelas_id', $kelas->id);
            })
            ->get();
        $totalPos = $race->pos->count();

        return view('admin.race-results.total-pos', compact('race', 'kelas', 'basketing', 'totalPos'));
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
