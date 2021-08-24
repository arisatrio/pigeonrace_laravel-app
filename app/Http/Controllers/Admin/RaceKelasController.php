<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Race;
use App\Models\RaceKelas;

class RaceKelasController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_race)
    {
        $race = Race::find($id_race);
        return view('admin.race.kelas-create', compact('race'));
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
                'nama_kelas' => 'required',
                'biaya'     => 'required',
            ]
        );

        $data = $request->all();
        $raceKelas = RaceKelas::create($data);

        return redirect()->route('admin.race.show', $raceKelas->race_id)->with('messages', 'Data Kelas Lomba berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($race_id, $id)
    {
        $kelas = RaceKelas::find($id);
        $race = Race::find($race_id);

        return view('admin.race.kelas-edit', compact('kelas', 'race'));
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
                'nama_kelas' => 'required',
                'biaya'     => 'required',
            ]
        );

        $data = $request->all();
        $raceKelas = RaceKelas::find($id);
        $raceKelas->update($data);

        return redirect()->route('admin.race.show', $raceKelas->race_id)->with('messages', 'Data Kelas Lomba berhasil diperpaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($race_id, $kelas)
    {
        $race = Race::find($race_id);
        $kelas = RaceKelas::find($kelas);
        $kelas->delete();
        
        return redirect()->route('admin.race.show', $race)->with('messages', 'Kelas Lomba Berhasil Dihapus');
    }
}
