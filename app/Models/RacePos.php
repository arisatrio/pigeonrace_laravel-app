<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RacePos extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'race_id',
        'no_pos',
        'tgl_inkorv',
        'tgl_lepasan',
        'city',
        'latitude',
        'longitude',
        'jarak',
        'biaya_inkorv',
    ];

    protected $dates = ['tgl_inkorv', 'tgl_lepasan'];

    // public function getJarakAttribute($value)
    // {
    //     return $value.' KM';
    // }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function basketing()
    {
        return $this->belongsToMany(Burung::class, 'race_basketings')
            ->using(RaceBasketing::class)
            ->as('basketing')
            ->withTimestamps();
    }

    public function clock()
    {
        return $this->belongsToMany(Burung::class, 'race_clocks')
            ->using(RaceClock::class)
            ->as('clock')
            ->withPivot('distance', 'arrival_date', 'arrival_day', 'arrival_clock', 'flying_time', 'velocity', 'no_stiker', 'status')
            ->withTimestamps();
    }
}
