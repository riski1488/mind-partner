<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamplePageController;

Route::get('/example', [ExamplePageController::class, 'index']);