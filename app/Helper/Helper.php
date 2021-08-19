<?php
namespace App\Helper;

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

            return number_format($km, 3)." KM";
        }
    }
}