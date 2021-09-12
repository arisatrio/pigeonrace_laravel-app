<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Race;
use App\Models\RaceKelas;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $race = Race::all();

        return view('admin.race.race', compact('race'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.race.race-create');
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
                'nama_race' => 'required',
                'tgl_race'  => 'required',
                'poster'    => 'required',
                'deskripsi'  => 'required'
            ]
        );

        $image              = $request->file('poster');
        $imageName          = time().'.'.$image->getClientOriginalExtension();
        $destinationPath    = public_path('assets/img/poster');
        $image->move($destinationPath, $imageName);
        
        $race = Race::create([
            'nama_race' => $request->nama_race,
            'slug'      => Str::slug($request->nama_race),
            'tgl_race'  => $request->tgl_race,
            'poster'    => $imageName,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.race.show', $race->id)->with('messages', 'Race Berhasil Dibuat. Silahkan lengkapi data Race');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $race = Race::with(['kelas', 'latihan', 'pos'])->find($id);

        return view('admin.race.race-show', compact('race'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $race = Race::find($id);

        return view('admin.race.race-edit', compact('race'));
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
                'nama_race' => 'required',
                'tgl_race'  => 'required',
                'deskripsi'  => 'required'
            ]
        );

        $race = Race::find($id);

        $imageName = $race->poster;
        if ($request->hasFile('poster')) {
            $image              = $request->file('poster');
            $imageName          = time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = public_path('assets/img/poster');
            $image->move($destinationPath, $imageName);
        }

        $race->update([
            'nama_race' => $request->nama_race,
            'tgl_race' => $request->tgl_race,
            'poster' => $imageName,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.race.index')->with('messages', 'Race telah diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $race = Race::find($id);
        $race->delete();

        return redirect()->route('admin.race.index')->with('messages', 'Data Race Berhasil Dihapus');
    }

    public function activated(Request $request, $id)
    {
        $race = Race::find($id);
        $race->update($request->all());

        return redirect()->route('admin.race.index')->with('messages', 'Race telah aktif');
    }

    public function finish(Request $request, $id)
    {
        $race = Race::find($id);
        $race->update(['status' => 'SELESAI']);

        return redirect()->route('admin.race.index')->with('messages', 'Race telah selesai');
    }
}
