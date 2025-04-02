<?php

use App\Http\Controllers\OzoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Observations routes
Route::prefix('observations')->group(function () {
    Route::controller(OzoneController::class)->group(function () {
        Route::name('observations.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
});
