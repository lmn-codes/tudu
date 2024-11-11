<?php

use Illuminate\Support\Facades\Route;

Route::get('/token', function () {
    return csrf_token();
});
