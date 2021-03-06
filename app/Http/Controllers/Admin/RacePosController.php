<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\Race;
use App\Models\RaceKelas;
use App\Models\RaceLatihan;
use App\Models\RacePos;
use App\Models\City;

class RacePosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_race)
    {
        $race = Race::find($id_race);
        $city = City::pluck('name');

        return view('admin.race.pos-create', compact('race', 'city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'no_pos'    => 'required',
                'tgl_inkorv' => 'required',
                'tgl_lepasan'     => 'required',
                'close_time'        => 'required',
                'restart_time'      => 'required',
                'city'  => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'biaya_inkorv' => 'required'
            ]
        );


        $racePos = RacePos::create([
            'race_id'       => $request->race_id,
            'limit_day'     => $request->limit_day,
            'limit_speed'   => $request->limit_speed,
            'no_pos'        => $request->no_pos,
            'tgl_inkorv'    => $request->tgl_inkorv,
            'tgl_lepasan'   => $request->tgl_lepasan,
            'close_time'    => $request->close_time,
            'restart_time'  => $request->restart_time,
            'city'          => $request->city,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'jarak'         => Helper::jarakDariBunderanWaru($request->latitude, $request->longitude),
            'biaya_inkorv'  => $request->biaya_inkorv,
        ]);

        return redirect()->route('admin.race.show', $racePos->race_id)->with('messages', 'Data Pos berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($race_id, $id)
    {
        $pos = RacePos::find($id);
        $selectedCity = $pos->city;
        $race = Race::find($race_id);
        $city = City::pluck('name');

        return view('admin.race.pos-edit', compact('pos', 'race', 'city', 'selectedCity'));
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
        $this->validate($request, 
            [
                'no_pos'            => 'required',
                'tgl_inkorv'        => 'required',
                'tgl_lepasan'       => 'required',
                'close_time'        => 'required',
                'restart_time'      => 'required',
                'city'              => 'required',
                'latitude'          => 'required',
                'longitude'         => 'required',
                'biaya_inkorv'      => 'required'
            ]
        );
        $pos = RacePos::find($id);
        $pos->update([
            'race_id'       => $request->race_id,
            'limit_day'     => $request->limit_day,
            'limit_speed'   => $request->limit_speed,
            'no_pos'        => $request->no_pos,
            'tgl_inkorv'    => $request->tgl_inkorv,
            'tgl_lepasan'   => $request->tgl_lepasan,
            'close_time'    => $request->close_time,
            'restart_time'  => $request->restart_time,
            'city'          => $request->city,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'jarak'         => Helper::jarakDariBunderanWaru($request->latitude, $request->longitude),
            'biaya_inkorv'  => $request->biaya_inkorv,
        ]);

        return redirect()->route('admin.race.show', $pos->race_id)->with('messages', 'Data Pos berhasil diperbaharui.');
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
