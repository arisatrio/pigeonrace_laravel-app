<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Burung extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id',
        'tahun',
        'no_ring',
        'warna',
        'jenkel',
        'titipan',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function basketing()
    {
        return $this->belongsToMany(RacePos::class, 'race_basketings')
            ->using(RaceBasketing::class)
            ->as('basketing')
            ->withTimestamps();
    }

    public function basketingKelas()
    {
        return $this->belongsToMany(RaceKelas::class, 'race_basketings')
            ->using(RaceBasketing::class)
            ->as('basketing')
            ->withTimestamps();
    }

    public function clock()
    {
        return $this->belongsToMany(RacePos::class, 'race_clocks')
            ->using(RaceClock::class)
            ->as('clock')
            ->withPivot('distance', 'arrival_date', 'arrival_day', 'arrival_clock', 'flying_time', 'velocity', 'no_stiker', 'status')
            ->withTimestamps();
    }

    public function burungClock()
    {
        return $this->hasMany(RaceClock::class, 'burung_id');
    }
}
