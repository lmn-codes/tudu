<?php

use App\Http\Controllers\TaskController;
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
