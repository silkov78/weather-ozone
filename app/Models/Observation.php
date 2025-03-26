<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Observation extends Model
{
    use HasFactory;

    protected $table = 'observations';
    protected $fillable = [
        'datetime', 'temperature', 'cloud_cover', 'weather_code', 'ozone',
    ];
}
