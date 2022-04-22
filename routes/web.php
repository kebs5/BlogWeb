<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrimeController;
use App\Http\Controllers\HomeController;
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
Route::resource('crime', CrimeController::class);

Route::get('/', [CrimeController::class, 'index']);

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

require __DIR__.'/auth.php';
