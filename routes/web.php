<?php

use App\Jobs\GetWeatherJob;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-queue', function () {
    $start = microtime(true);
    GetWeatherJob::dispatch();
    $end = microtime(true);
    return "Dispatched in " . ($end - $start) . " seconds";
});
