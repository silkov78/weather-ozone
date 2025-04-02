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
     * Если запрос содержит невалидные данные,
     * переадресует на последнюю посещённую страницу.
     */
    public function filterByDate(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        dump($validatedData);

        $startDate = new \DateTime($validatedData['start_date']);
        $endDate = new \DateTime($validatedData['end_date']);

        $observations = Observation::whereBetween('datetime', [$startDate, $endDate])->get();

        if (! $observations) {
            return response()->json(['message' => 'No observations found']);
        }

        return response()->json($observations);
    }

}
