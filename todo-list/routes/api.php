<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'getAllTasks']);
Route::post('/tasks', [\App\Http\Controllers\TaskController::class, 'addTask']);
Route::delete('/tasks/{id}', [\App\Http\Controllers\TaskController::class, 'deleteTask']);
Route::put('/tasks/{id}', [\App\Http\Controllers\TaskController::class, 'markTaskCompleted']);

Route::post('/folders', [\App\Http\Controllers\FolderController::class, 'addNewFolder']);
