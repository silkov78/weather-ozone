<?php

namespace App\Http\Controllers;

use App\Models\Observation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OzoneController extends Controller
{
    public function index(): string
    {
        $lastObservation = Observation::all()->last();

        if (! $lastObservation) {
            return response()->json(['message' => 'No observations found'], 404);
        }

        return response()->json($lastObservation);
    }
}
