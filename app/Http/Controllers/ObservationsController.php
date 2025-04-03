<?php

namespace App\Http\Controllers;

use App\Models\Observation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ObservationsController
{
    public function index(): JsonResponse
    {
        $lastObservation = Observation::all()->last();

        if (! $lastObservation) {
            return response()->json(['message' => 'Observations are not found.'], 404);
        }

        return response()->json($lastObservation);
    }
}
