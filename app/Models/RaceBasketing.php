<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RaceBasketing extends Pivot
{
    protected $table = 'race_basketings';
    protected $fillable = ['raca_pos_id', 'burung_id'];
}
