<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'datetime' => $this->datetime->format('Y-m-d H:i:s'),
            'temperature' => $this->temperature,
            'cloud_cover' => $this->cloud_cover,
            'weather_code' => $this->weather_code,
            'ozone' => $this->ozone,
        ];
    }
}
