<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Services\WeatherServiceProvider\Enums\WeatherCode;

return new   class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('observations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('observation_datetime');
            $table->decimal('temperature', 4, 2);
            $table->integer('cloud_cover');
            $table->enum(
                'weather_code', array_column(WeatherCode::cases(), 'value')
            );
            $table->decimal('ozone', 6, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observations');
    }
};
