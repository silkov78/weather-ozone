<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ObservationRequest;
use App\Http\Resources\ObservationResource;
use App\Http\Resources\ObservationResourceCollection;
use App\Models\Observation;
use Illuminate\Http\JsonResponse;

/*
 * Контроллер отвечает за API, предоставляющие данные о наблюдениях за озоном.
 */
class ObservationsApiController
{
    /*
     * Возвращает последнее наблюдение.
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

    /*
     * Возвращает наблюдения из заданного временного отрезка.
     * start_date и end_date приходят в строке запроса.
     */
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
