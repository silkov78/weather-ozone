<?php

use App\Http\Controllers\ObservationsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Observations routes
Route::controller(ObservationsController::class)->group(function () {
   Route::prefix('api/observations')->group(function () {
      Route::name('observations.')->group(function () {

          Route::get('/', 'index')->name('home');

      });
   });
});
