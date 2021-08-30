<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\Race;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $race = Race::where('status', 'AKTIF')->get();

        return view('user.race', compact('race'));
    }

    public function indexRiwayat()
    {
        $race = Race::whereHas('join', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();

        return view('user.riwayat', compact('race'));
    }

    public function show($slug)
    {
        $race = Race::where('slug', $slug)->first();

        return view('user.race-show', compact('race'));
    }

    public function joinRace($race_id)
    {
        $race = Race::find($race_id);
        $user = auth()->user();

        if (!$race->join->contains($user)) {
            $race->join()->attach($user, ['status' => 1]);
        }

        return redirect()->route('user.home')->with('messages', 'Anda telah mengikuti race');
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
