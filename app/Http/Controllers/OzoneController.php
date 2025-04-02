<?php

namespace App\Http\Controllers;

use App\Models\Observation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OzoneController extends Controller
{
    public function index(): array
    {
        return Observation::all()->toArray();
    }
}
