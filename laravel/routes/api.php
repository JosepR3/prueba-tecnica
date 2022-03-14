<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::get('getItem/{id}', [ApiController::class, 'getItemById']);
Route::get('getItems', [ApiController::class, 'getItems']);
Route::get('calculateTax/{id}',  [ApiController::class, 'calculateTax']);


