<?php

use App\Http\Controllers\OzoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/observations', [OzoneController::class, 'index'])->name('observations');
