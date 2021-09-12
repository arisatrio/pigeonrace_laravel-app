<?php
namespace App\Helper;

use Carbon\Carbon;
use Carbon\CarbonInterval;

use App\Models\RacePos;

class Helper
{
    public static function DDMtoDD($input)
    {
        $new = explode("°", $input);
        $new2 = $new[1];

        $deg = $new[0];
        $min = rtrim($new[1], " ' ");
        
        $dec = $deg+($min/60);

        return number_format($dec, 6);
    }

    public static function jarakDariBunderanWaru($lat, $long)
    {
        $waruLat = "07° 21.260'";
        $waruLong = "112° 42.569'";
        $jarak = self::calculateDistance($waruLat, $waruLong, $lat, $long );

        return $jarak;
    }

    public static function calculateDistance($lat1, $long1, $lat2, $long2)
    {
        -$lat1 = self::DDMtoDD($lat1);
        $long1 = self::DDMtoDD($long1);
        -$lat2 = self::DDMtoDD($lat2);
        $long2 = self::DDMtoDD($long2);

        if ( ($lat1 == $lat2) && ($long1 == $long2) ) {
            return 0;
        } else {
            $theta  = $long1 - $long2;
            $dist   = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist   = acos($dist);
            $dist   = rad2deg($dist);
            $miles  = $dist * 60 * 1.1515;
            $km     = $miles * 1.609344;

            return number_format($km, 2);
        }
    }

    public static function estimateArrival($jarak, $kecepatan, $start_time)
    {
        $waktu = ($jarak * 1000) / $kecepatan; // in minute
        $dayFly = round($waktu / 720);
        if($waktu > 720 && $waktu <= 1440){
            $waktu += 720;
        } else if($waktu > 1440){
			$waktu += (720 * $dayFly);
		} else {
            $waktu = $waktu;
        }
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

    public static function noRing($club, $tahun, $no_ring)
    {
        $ring = $club.substr($tahun, -2)."-".$no_ring;

        return $ring;
    }

    public static function getAvgSpeed($obj)
    {
        
            $totalSpeed = 0;
            foreach($obj as $key => $item){
                $totalSpeed +=  $item->velocity;
            }

            if($totalSpeed === 0){
                $avg = 0;
            }
            $avg = $totalSpeed / $obj->count();
            
            return $avg;
        // } else {
        //     return 0;
        // }

    }

    public static function getTotalSpeed($obj)
    {
        $totalSpeed = 0;
        foreach($obj as $key => $item){
            $totalSpeed +=  $item->velocity;
        }

        return $totalSpeed;
    }

    public static function getRankInPos($pos_id, $burung_id)
    {
        $pos = RacePos::find($pos_id);
        $clock = $pos->clock()->where('race_clocks.status', 'SAH')->orderBy('velocity', 'DESC')->get();
        $collection = collect($clock);
        $data       = $collection->where('id', $burung_id);
        $rank       = $data->keys()->first() + 1;

        return $rank;
    }

}