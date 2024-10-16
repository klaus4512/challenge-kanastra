<?php

use App\Http\Controllers\API\BilletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/billet', [BilletController::class, 'store']);
