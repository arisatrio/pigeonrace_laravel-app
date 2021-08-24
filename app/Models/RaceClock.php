<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RaceClock extends Pivot
{
    protected $table = 'race_clocks';
    protected $fillable = [
        'race_pos_id',
        'burung_id',
        'distance',
        'arrival_date',
        'arrival_day',
        'arrival_clock',
        'flying_time',
        'velocity',
        'no_stiker',
        'status'
    ];

    public function getVelocityAttribute($value)
    {
        return $value.' M/Menit';
    }
}