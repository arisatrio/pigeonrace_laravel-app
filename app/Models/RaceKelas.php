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
}
