<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role_id',
        'email',
        'nohp',
        'city',
        'latitude',
        'longitude',
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function koordinat()
    {
        return $this->hasOne(koordinat::class);
    }

    public function burung()
    {
        return $this->hasMany(Burung::class);
    }

    public function isAdmin(){
        return (\Auth::user()->role_id == 2);
    }

    public function isUser(){
        return (\Auth::user()->role_id == 3);
    }

    public function join()
    {
        return $this->belongsToMany(Race::class, 'users_join_races')
        ->using(JoinRace::class)
        ->as('join')
        ->withPivot('status')
        ->withTimestamps();
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
