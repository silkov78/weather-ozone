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
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Observation $observation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Observation $observation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Observation $observation)
    {
        //
    }
}
