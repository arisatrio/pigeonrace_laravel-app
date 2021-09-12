<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClockModel extends Model
{
    protected $table = 'race_clocks';
    protected $appends = ['rank'];

    protected $dates = ['arrival_date', 'arrival_clock'];

    public function getRankAttribute()
    {
        $collection = collect(ClockModel::orderBy('velocity', 'DESC')->get());
        $data       = $collection->where('id', $this->id);
        $value      = $data->keys()->first() + 1;
        
        return $value;
    }

    public function pos()
    {
        return $this->belongsTo(RacePos::class, 'race_pos_id');
    }

    public function burung()
    {
        return $this->belongsTo(Burung::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}