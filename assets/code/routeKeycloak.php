<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeycloakController;
use App\Http\Controllers\Api\KeywordController;

Route::get('auth/redirect', [KeycloakController::class, 'redirect'])->name('login');
Route::get('auth/callback', [KeycloakController::class, 'callback']);

Route::middleware('auth')->group(function () {
    Route::get('logout',[KeycloakController::class, 'logout']);
});