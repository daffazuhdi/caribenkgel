<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VehicleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/car/models/{id}', [VehicleController::class, 'getModels'])->name('car.models'); // apinya ngambil dari sini, jadi route ini itu bukan untuk nampilan page, tapi untuk ngambil data car model berdasarkan dari car brandnya
