<?php

namespace App\Http\Controllers;

use App\Models\Observation;
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
    public function index(): JsonResponse
    {
        $lastObservation = Observation::all()->last();

        if (! $lastObservation) {
            return response()->json(['message' => 'Observations are not found.'], 200);
        }

        return response()->json($lastObservation);
    }
}
