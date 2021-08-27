<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = ['nama_race', 'slug', 'tgl_race', 'deskripsi', 'poster', 'status'];
    protected $dates = ['tgl_race'];

    public function kelas()
    {
        return $this->hasMany(RaceKelas::class);
    }

    public function latihan()
    {
        return $this->hasMany(RaceLatihan::class);
    }

    public function pos()
    {
        return $this->hasMany(RacePos::class);
    }

    public function join()
    {
        return $this->belongsToMany(User::class, 'users_join_races')
        ->using(JoinRace::class)
        ->as('join')
        ->withPivot('status')
        ->withTimestamps();
    }
}
