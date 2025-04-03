<?php

use App\Http\Controllers\ObservationsApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Observations routes
Route::controller(ObservationsApiController::class)->group(function () {
   Route::prefix('api/observations')->group(function () {
      Route::name('observations.')->group(function () {

          Route::get('/', 'index')->name('index');
          Route::get('/filter', 'filterByDate')->name('filter');
      });
   });
});
