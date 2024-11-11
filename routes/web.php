<?php

use App\Http\Controllers\DayController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskEntryController;
use Illuminate\Support\Facades\Route;

Route::get('/token', function () {
    return csrf_token();
});
