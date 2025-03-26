<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    protected $table = 'observations';
    protected $fillable = [
        'datetime', 'temperature', 'cloud_cover', 'weather_code', 'ozone',
    ];
}
