<?php

use App\Http\Controllers\ObservationsApiController;
use Illuminate\Support\Facades\Route;


// api/v1/observations
Route::controller(ObservationsApiController::class)->group(function () {
    Route::prefix('v1/observations')->group(function () {
        Route::name('observations.')->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/filter', 'filterByDate')->name('filter');
        });
    });
});
