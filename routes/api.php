<?php

use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;



Route::get('/logs/count', [LogController::class, 'index']);
