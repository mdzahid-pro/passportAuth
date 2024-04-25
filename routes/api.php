<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\Admin\AdminLoginController::class,'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['apiAuth:api']);
