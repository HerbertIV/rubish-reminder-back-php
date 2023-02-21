<?php

use App\Http\Controllers\AsyncController;
use Illuminate\Support\Facades\Route;

Route::get('async/regions', [AsyncController::class, 'regions'])->name('async.regions');
