<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\Burung;
use App\Models\Race;
use App\Models\RaceKelas;
use App\Models\RacePos;
use App\Models\ClockModel;

class HasilRaceController extends Controller
{
    public function index()
    {
        $race = Race::where('status', 'AKTIF')->orWhere('status', 'SELESAI')->orderBy('tgl_race', 'DESC')->get();

        return view('welcome', compact('race'));
    }

    public function show($slug)
    {
        $race = Race::with(['pos' => function ($q) {
            $q->orderBy('no_pos', 'ASC');
        }, 'join'])->where('slug', $slug)->first();

        return view('race-result', compact('race'));
    }

    public function basketing($race_id, $id)
    {
        $race = Race::find($race_id);
        $kelas = $race->kelas->first();
        $pos = RacePos::with(['race', 
        'basketing' => function($q) use($id, $kelas) {
            $q->with(['club', 'user' => function ($query){
                $query->orderBy('name');
            }])->where('race_pos_id', $id)->where('race_kelas_id', $kelas->id);
        }])->find($id);

        return view('basketing', compact('race', 'pos', 'kelas'));
    }

    public function basketingKelas($race_id, $id, $kelas_id)
    {
        $race = Race::find($race_id);
        $kelas = $race->kelas->find($kelas_id);
        $pos = RacePos::with(['race', 
        'basketing' => function($q) use($id, $kelas) {
            $q->with(['club', 'user' => function ($query){
                $query->orderBy('name');
            }])->where('race_pos_id', $id)->where('race_kelas_id', $kelas->id);
        }])->find($id);

        return view('basketing', compact('race', 'pos', 'kelas'));
    }

    public function pos($race_id, $id)
    {
        $pos = RacePos::with([
            'race' => function ($q) {
                $q->with('kelas');
            },
            'basketing' => function ($q) use($id) {
                $q->where('race_pos_id', $id);
            },
            'clock' => function ($q) use($id) {
                $q->with(['club','user' => function ($query) {
                    $query->orderBy('name');
                }
                ])->where('race_pos_id', $id);
            }
        ])->find($id);

        return view('pos', compact('pos'));
    }

    public function posKelas($race_id, $id, $kelas_id)
    {
        $kelas = RaceKelas::find($kelas_id);
        $pos = RacePos::with([
            'race',
            'basketing' => function ($q) use($id, $kelas_id) {
                $q->where('race_pos_id', $id)->where('race_kelas_id', $kelas_id);
            },
            'clock' => function ($q) use($id, $kelas_id) {
                $q->with(['club'])->where('race_pos_id', $id)->where('race_kelas_id', $kelas_id)->orderBy('velocity', 'DESC');
            },
            'clock.user' => function ($q) {
                $q->orderBy('name');
            },
        ])->find($id);

        return view('pos-kelas', compact('pos', 'kelas'));
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

        return view('total-pos', compact('race', 'kelas', 'basketing', 'totalPos'));
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

        return view('total-pos', compact('race', 'kelas', 'basketing', 'totalPos'));
    }

}
