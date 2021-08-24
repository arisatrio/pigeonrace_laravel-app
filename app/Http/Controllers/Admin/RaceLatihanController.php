<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Race;
use App\Models\RaceKelas;
use App\Models\RaceLatihan;
use App\Models\City;

class RaceLatihanController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_race)
    {
        $race = Race::find($id_race);
        $city = City::pluck('name');

        return view('admin.race.latihan-create', compact('race', 'city'));
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
                'tgl_inkorv' => 'required',
                'tgl_lepasan'     => 'required',
                'city'  => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'jarak' => 'required',
                'biaya_inkorv' => 'required'
            ]
        );

        $data = $request->all();
        $raceLatihan = RaceLatihan::create($data);

        return redirect()->route('admin.race.show', $raceLatihan->race_id)->with('messages', 'Data Latihan berhasil ditambahkan.');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($race_id, $id)
    {
        $lat = RaceLatihan::find($id);
        $race = Race::find($race_id);
        $city = City::pluck('name');

        return view('admin.race.latihan-edit', compact('lat', 'race', 'city'));
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
                'tgl_inkorv' => 'required',
                'tgl_lepasan'     => 'required',
                'city'  => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'jarak' => 'required',
                'biaya_inkorv' => 'required'
            ]
        );

        $data = $request->all();
        $lat = RaceLatihan::find($id);
        $lat->update($data);

        return redirect()->route('admin.race.show', $lat->race_id)->with('messages', 'Data Latihan berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($race_id, $latihan)
    {
        $race = Race::find($race_id);
        $latihan = RaceLatihan::find($latihan);
        $latihan->delete();

        return redirect()->route('admin.race.show', $race)->with('messages', 'Data Latihan Berhasil Dihapus');
    }
}
