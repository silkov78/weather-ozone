<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\WeatherServiceProvider\Enums\WeatherCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Observation extends Model
{
    use HasFactory;

    protected $table = 'observations';
    protected $fillable = [
        'datetime',
        'temperature',
        'cloud_cover',
        'weather_code',
        'ozone',
    ];

    protected $casts = [
        'datetime' => 'datetime',
        'temperature' => 'float',
        'cloud_cover' => 'int',
        'weather_code' => WeatherCode::class,
        'ozone' => 'float',
    ];
}
