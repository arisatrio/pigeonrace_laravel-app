<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceKelas extends Model
{
    use HasFactory;

    protected $fillable = ['race_id', 'nama_kelas', 'biaya'];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function basketingKelas()
    {
        return $this->belongsToMany(RacePos::class, 'race_basketings')
            ->using(RaceBasketing::class)
            ->as('basketing')
            ->withTimestamps();
    }

    public function clockPos()
    {
        return $this->belongsToMany(RacePos::class, 'race_clocks')
            ->using(RaceClock::class)
            ->as('clock')
            ->withPivot('distance', 'arrival_date', 'arrival_day', 'arrival_clock', 'flying_time', 'velocity', 'no_stiker', 'status')
            ->withTimestamps();
    }

    public function clockBurung()
    {
        return $this->belongsToMany(Burung::class, 'race_clocks')
            ->using(RaceClock::class)
            ->as('clock')
            ->withPivot('distance', 'arrival_date', 'arrival_day', 'arrival_clock', 'flying_time', 'velocity', 'no_stiker', 'status')
            ->withTimestamps();
    }
}
