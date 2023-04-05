<?php

use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => '/users/process'], function () {
    Route::get('/change-email/{token}', [UserController::class, 'changeEmail'])->name('user.process.email');
    Route::get('/change-phone', [UserController::class, 'changePhone'])->name('user.process.phone');
});


Route::group([ "middleware" => ['auth:sanctum', config('jetstream.auth_session'), 'verified'] ], function() {
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::resource('/regions', RegionController::class);
    Route::resource('/users', UserController::class);

    require 'async.php';
});
