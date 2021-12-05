<?php

use App\Http\Controllers\API\CustomerController;
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

Route::post('/cliente', [CustomerController::class, 'store']);
Route::put('/cliente/{id}', [CustomerController::class, 'update']);
Route::get('/cliente/{id}', [CustomerController::class, 'show']);
Route::delete('/cliente/{id}', [CustomerController::class, 'destroy']);
Route::get('/consulta/final-placa/{numero}', [CustomerController::class, 'searchByLicensePlateLastNumber']);
