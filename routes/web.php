<?php

use App\Http\Controllers\FikaController;
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

Route::get('/', [FikaController::class, 'index'])->name('fika.create');
Route::post('/', [FikaController::class, 'store'])->name('fika.store');
Route::get('/{fika:slug}', [FikaController::class, 'show'])->name('fika.show');
Route::get('/{fika:slug}/times', [FikaController::class, 'times'])->name('fika.times');
