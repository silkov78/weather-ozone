<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ObservationResource;
use App\Models\Observation;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function filterByDate(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
            ]);
        } catch (ValidationException $e)  {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid query parameters.',
                'errors' => $e->errors()
            ], 400);
        }

        $start_date = new \DateTime($validatedData['start_date']);
        $end_date = new \DateTime($validatedData['end_date']);

        $observations = Observation::whereBetween(
            'datetime', [$start_date, $end_date]
        )->get();


        if ($observations->isEmpty()) {
            return response()->json(
                ['message' => 'Observations from date ran ge are not found.'],
                404
            );
        }

        return response()->json($observations);
    }
}
