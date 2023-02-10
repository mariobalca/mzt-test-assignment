<?php

use App\Http\Controllers\CandidateController;
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
    return view('homepage');
});

Route::prefix('candidates')->group(function () {
    Route::get('/', [CandidateController::class, 'index'])->name('list');
    Route::post('/{id}/contact', [CandidateController::class, 'contact'])->name('contact');
    Route::put('/{id}/hire', [CandidateController::class, 'hire'])->name('hire');
});
