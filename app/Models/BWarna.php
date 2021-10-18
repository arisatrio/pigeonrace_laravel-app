<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BWarna extends Model
{
    protected $table = 'bwarnas';
    protected $fillable = ['kode_warna', 'warna'];
}
