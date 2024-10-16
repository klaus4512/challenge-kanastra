<?php

use App\Http\Controllers\API\BilletController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
