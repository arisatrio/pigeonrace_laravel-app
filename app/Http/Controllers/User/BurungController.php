<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Club;
use App\Models\Burung;

class BurungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $burung = Burung::whereHas('user', function ($q){
            $q->where('user_id', auth()->user()->id);
        })->get();

        return view('user.burung', compact('burung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun = range(Carbon::now()->year, 2018);
        $club = Club::all();
        return view('user.burung-create', compact('tahun', 'club'));
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
                'club_id' => 'required',
                'tahun'   => 'required',
                'no_ring'   => 'required',
                'warna'     => 'required',
                'user_id'   => 'required'
            ]
        );

        $data = $request->all();
        Burung::create($data);

        return redirect()->route('user.burung.index')->with('messages', 'Data Burung Telah Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Burung $burung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Burung $burung)
    {
        $tahun = range(Carbon::now()->year, 2018);
        $club = Club::all();

        return view('user.burung-edit', compact('tahun', 'club', 'burung'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Burung $burung)
    {
        $this->validate($request, 
            [
                'club_id' => 'required',
                'tahun'   => 'required',
                'no_ring'   => 'required',
                'warna'     => 'required',
                'user_id'   => 'required'
            ]
        );

        $data = $request->all();
        $burung->update($data);

        return redirect()->route('user.burung.index')->with('messages', 'Data Burung Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Burung $burung)
    {
        $burung->delete();

        return redirect()->route('user.burung.index')->with('messages', 'Data Burung Berhasil Dihapus');
    }
}
