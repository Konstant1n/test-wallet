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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('users')->group(function () {
    Route::post('{userId}/withdraw', [ApiController::class, 'withdraw']);
    Route::get('{userId}/balance-and-transactions', [ApiController::class, 'viewBalanceAndTransactions']);
    Route::post('{userId}/deposit', [ApiController::class, 'deposit']);
});

