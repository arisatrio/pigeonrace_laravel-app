<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class JoinRace extends Pivot
{
    protected $table = 'users_join_races';
    protected $fillable = ['user_id', 'race_id', 'status'];

}
