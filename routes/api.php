<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::resources([
    'news' => NewsController::class,
]);
