<?php

use App\Http\Controllers\API\CheckController;
use App\Http\Controllers\API\RegionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('check', [CheckController::class, 'check']);

Route::get('regions', [RegionController::class, 'index']);
Route::post('check-region', [RegionController::class, 'checkRegion']);

