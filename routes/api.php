<?php

use App\Http\Controllers\ObservationsController;
use Illuminate\Support\Facades\Route;


// api/v1/observations
Route::get(
    '/v1/observations/filter', [ObservationsController::class, 'filterByDate']
)->name('observations.filter');

Route::apiResource(
    'v1/observations', ObservationsController::class
)->only(['index']);
