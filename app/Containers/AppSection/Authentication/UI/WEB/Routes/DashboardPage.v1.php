<?php

use App\Containers\AppSection\Authentication\UI\WEB\Controllers\DashboardPageController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardPageController::class)
    ->name('dashboard')
    ->middleware('auth:web');
