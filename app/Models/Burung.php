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
}
