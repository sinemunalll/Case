<?php

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
Route::get('/teams',\App\Http\Controllers\Team\IndexController::class)->name('teams');
Route::get('/fixtures',\App\Http\Controllers\Team\FixtureController::class)->name('fixture');
Route::get('/simulations',\App\Http\Controllers\Team\SimulationController::class)->name('simulations');
Route::get('/fixtures/all/{week}',\App\Http\Controllers\Team\FixtureAllController::class)->name('fixtureAll');
Route::get('/fixtures/all/week/play',\App\Http\Controllers\Team\PlayAllWeekController::class)->name('playAllWeek');



