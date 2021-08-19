<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceLatihan extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'race_id',
        'tgl_inkorv',
        'tgl_lepasan',
        'city',
        'latitude',
        'longitude',
        'jarak',
        'biaya_inkorv',
    ];

    protected $dates = ['tgl_inkorv', 'tgl_lepasan'];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
