<?php
namespace App\Helper;

use Carbon\Carbon;
use Carbon\CarbonInterval;

class Helper
{
    public static function calculateDistance($lat1, $long1, $lat2, $long2)
    {
        if ( ($lat1 == $lat2) && ($long1 == $long2) ) {
            return 0;
        } else {
            $theta  = $long1 - $long2;
            $dist   = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist   = acos($dist);
            $dist   = rad2deg($dist);
            $miles  = $dist * 60 * 1.1515;
            $km     = $miles * 1.609344;

            return number_format($km, 3);
        }
    }

    public static function estimateArrival($jarak, $kecepatan, $start_time)
    {
        $waktu = ($jarak * 1000) / $kecepatan; // in minute
        $fly = Carbon::parse($start_time)->addMinutes($waktu);

        return $fly->locale('id')->isoFormat('LLLL');
    }

    public static function calculateVelocity($jarak, $waktu)
    {
        $waktu = CarbonInterval::fromString($waktu);
        $kecepatan = ($jarak * 1000) / $waktu->totalMinutes;

        return number_format($kecepatan, 2);
    }

    public static function birdName($obj, $pemilik)
    {
        $name = $obj->club->nama_club.substr($obj->tahun, -2)."-".$obj->no_ring."-".$obj->jenkel."-".$obj->warna." / ".$pemilik;

        return $name;
    }

}