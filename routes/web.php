<?php

use App\Http\Controllers\ObservationsApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
