<?php

use App\Services\WeatherServiceProvider\Enums\WeatherCode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('observations', function (Blueprint $table) {
            $table->integer('weather_code')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('observations', function (Blueprint $table) {
            $table->enum(
                'weather_code', array_column(WeatherCode::cases(), 'value')
            );
        });
    }
};
