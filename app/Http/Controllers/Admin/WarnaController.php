<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BWarna;

class WarnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warna = BWarna::all();

        return view('admin.warna', compact('warna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.warna-create');
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
                'kode_warna' => 'required|unique:bwarnas,kode_warna',
                'warna' => 'required|unique:bwarnas,warna',
            ]
        );

        BWarna::create([
            'kode_warna' => $request->kode_warna,
            'warna' => $request->warna,
        ]);

        return redirect()->route('admin.warna.index')->with('messages', 'Club Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BWarna $warna)
    {
        return view('admin.warna-edit', compact('warna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BWarna $warna)
    {
        $this->validate($request, 
            [
                'kode_warna' => 'required',
                'warna' => 'required',
            ]
        );

        $warna->update([
            'kode_warna' => $request->kode_warna,
            'warna' => $request->warna,
        ]);

        return redirect()->route('admin.warna.index')->with('messages', 'Club Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BWarna $warna)
    {
        $warna->delete();

        return redirect()->route('admin.warna.index')->with('messages', 'Club Berhasil Dihapus');
    }
}
