<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObservationRequest;
use App\Http\Resources\ObservationResource;
use App\Http\Resources\ObservationResourceCollection;
use App\Models\Observation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ObservationsController
{
    public function index(): ObservationResource|JsonResponse
    {
        $lastObservation = Observation::latest('datetime')->first();

        if (! $lastObservation) {
            return response()->json(
                ['message' => 'Observations are not found.'],404
            );
        }

        return new ObservationResource($lastObservation);
    }

    public function filterByDate(
        ObservationRequest $request
    ): ObservationResourceCollection|JsonResponse
    {
        $validated = $request->validated();

        $observations = Observation::whereBetween(
            'datetime',
            [$validated['start_date'], $validated['end_date']]
        )->get();

        if ($observations->isEmpty()) {
            return response()->json(
                ['message' => 'Observations from date range are not found.'],
                404
            );
        }

        return new ObservationResourceCollection($observations);
    }
}
