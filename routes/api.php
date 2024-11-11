<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', fn () => 'pong');

Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index');
    Route::get('/tasks/{id}', 'show');
    Route::post('/tasks', 'create');
    Route::patch('/tasks/{id}', 'update');
    Route::delete('/tasks/{id}', 'delete');
});

Route::controller(TaskEntryController::class)->group(function () {
    Route::get('/tasks/{task_id}/entries', 'index');
    Route::post('/tasks/{task_id}/entries', 'create');
    Route::patch('/entries/{id}/stop', 'stopEntry');
});

Route::controller(DayController::class)->group(function () {
    Route::post('/days', 'create');
    Route::put('/days/{day_id}/tasks', 'editTasks');
});
