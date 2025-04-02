<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Observation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OzoneController extends Controller
{
    /*
     * Возвращает последнее добавленное наблюдение.
     */
    public function index(): JsonResponse
    {
        $lastObservation = Observation::all()->last();

        if (! $lastObservation) {
            return response()->json(['message' => 'No observations found'], 404);
        }

        return response()->json($lastObservation);
    }

    /*
     * Получает из запроса начальную и конечную дату и фильтрует данные по ним.
     */
    public function filterByDate(Request $request): JsonResponse
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = new \DateTime($request->input('start_date'));
        $endDate = new \DateTime($request->input('end_date'));

        $observations = Observation::whereBetween('datetime', [$startDate, $endDate])->get();

        if (! $observations) {
            return response()->json(['message' => 'No observations found'], 404);
        }

        return response()->json($observations);
    }

}
