<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/employees', [\App\Http\Controllers\EmployeeController::class, 'all']);
Route::get('/employees/{id}', [\App\Http\Controllers\EmployeeController::class, 'getSingleEmployee']);
Route::post('/employees', [\App\Http\Controllers\EmployeeController::class, 'create']);


Route::get('/timesheets', [\App\Http\Controllers\TimesheetController::class, 'getAllTimesheets']);
Route::get('/timesheets/{id}', [\App\Http\Controllers\TimesheetController::class, 'getTimesheetsByEmployee']);
Route::post('/timesheets', [\App\Http\Controllers\TimesheetController::class, 'addTimesheet']);
Route::put('/timesheets/{id}', [\App\Http\Controllers\TimesheetController::class, 'updateTimesheet']);

Route::get('/contracts', [\App\Http\Controllers\ContractController::class, 'all']);

Route::get('/teams', [\App\Http\Controllers\TeamController::class, 'getAllTeams']);
Route::get('/teams/{id}', [\App\Http\Controllers\TeamController::class, 'getTeamById']);
Route::post('/teams', [\App\Http\Controllers\TeamController::class, 'addNewTeam']);
Route::put('/teams/{id}', [\App\Http\Controllers\TeamController::class, 'addEmployeeToTeam']);
Route::delete('/teams/{id}', [\App\Http\Controllers\TeamController::class, 'removeEmployeeFromTeam']);
