<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use DB;

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

    public function basketing($race_id, $id)
    {
        $race = Race::with('pos')->find($race_id);
        $pos = RacePos::with(['basketing' => function ($q) {
            $q->with(['user', 'club']);
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
        $rank = $pos->clock()->where('race_clocks.race_kelas_id', $kelas_id)->where('race_clocks.status', 'SAH')->orderBy('race_clocks.velocity', 'DESC')->get();

        return view('admin.race-results.pos-kelas', compact('pos', 'kelas', 'rank'));
    }

    public function totalPos($race_id)
    {
        $race = Race::with('pos', 'join')->find($race_id);
        $pos = $race->pos()->get();
        $totalPos = $pos->count();
        
        // foreach($pos as $item){
        //     $data = $item->clock()->where('race_clocks.status', 'SAH')->orderBy('race_clocks.velocity', 'DESC')->get();
        //     foreach($data as $item2){
        //         $temp[] = collect(
        //             [
        //                 'nama'          => $item2->user->name,   
        //                 'kota'          => $item2->user->city,
        //                 'no_ring'       => Helper::noRing($item2->club->nama_club,$item2->tahun, $item2->no_ring),
        //                 'race_pos_id'   => $item2->clock->race_pos_id,
        //                 'velocity'      => $item2->clock->velocity,
        //                 'total_clock'   => $item2->basketing->count(),
        //             ],
        //         );
        //     }
        // }
        // $coll = collect($temp);

        // $query = $race->query()
        //     ->leftJoin('race_pos', 'races.id', '=', 'race_pos.race_id')
        //     ->leftJoin('race_clocks', 'race_pos.id', '=', 'race_clocks.race_pos_id')
        //     ->leftJoin('burungs', 'burungs.id', '=', 'race_clocks.burung_id')
        //     ->leftJoin('clubs', 'clubs.id', '=', 'burungs.club_id')
        //     ->leftJoin('users', 'users.id', '=', 'burungs.user_id')
        //     ->where('race_clocks.status', 'SAH')
        //     //->select('users.name', 'clubs.nama_club', 'burungs.tahun', 'burungs.no_ring', 'race_pos.no_pos', 'race_pos.no_pos', 'race_pos.city', 'race_clocks.velocity')
        //     // ->select('users.name', 'race_clocks.burung_id', 'clubs.nama_club', 'burungs.tahun', 'burungs.no_ring')
        //     // //->orderBy('race_clocks.velocity', 'DESC')
        //     // ->groupBy('race_clocks.burung_id')
        //     // ->get()->toArray()
        //     ;


        // $burung = $query->select('users.name', 'race_clocks.burung_id', 'clubs.nama_club', 'burungs.tahun', 'burungs.no_ring')->get()->toArray();
        // $clock = $query->select('race_clocks.burung_id', 'race_clocks.race_pos_id', 'race_clocks.velocity')->get()->toArray();

        // $collBurung = collect($burung);
        // //$collClock = collect($clock);        

        // dd($clock);



        $coll = Burung::with(['clock', 'club', 'user'])->get();

        // $bur = Burung::with('clock')->get();


        // foreach($bur as $item){
        //     foreach($item->clock as $item2){
        //         if(!$item->clock->has($item2->clock->velocity)){
        //             $item->clock->put('velocity', 0);
        //         }
        //     }
        // }

        //dd($coll);
        

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
