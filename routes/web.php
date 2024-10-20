<?php

use App\Http\Controllers\DayController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskEntryController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    // return 'pong';
    return csrf_token();
});

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
