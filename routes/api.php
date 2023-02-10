<?php

use App\Http\Controllers\API\CompanyAPIController;
use App\Http\Controllers\API\CandidateAPIController;
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

Route::get('company',[ CompanyAPIController::class, 'get']);

Route::prefix('candidate')->group(function () {
    Route::post('/{candidate}/contact', [CandidateAPIController::class, 'contact'])->name('contact');
    Route::put('/{candidate}/hire', [CandidateAPIController::class, 'hire'])->name('hire');
});
