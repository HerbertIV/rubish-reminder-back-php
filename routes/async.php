<?php

use App\Http\Controllers\AsyncController;
use Illuminate\Support\Facades\Route;

Route::get('async/regions', [AsyncController::class, 'regions'])->name('async.regions');
Route::get('async/rubbish-type', [AsyncController::class, 'rubbishType'])->name('async.rubbish-type');
Route::get('async/region-types', [AsyncController::class, 'regionTypes'])->name('async.region-types');
