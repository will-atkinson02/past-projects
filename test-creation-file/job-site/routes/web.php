<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('Jobdata', [\App\Http\Controllers\JobdataController::class, 'addJobdata']);
