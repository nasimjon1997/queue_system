<?php

use App\Http\Controllers\QueueCabinetController;
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

Route::get('/',[QueueCabinetController::class, 'index'])->name('home');
Route::post('/reserve-cabinet',[QueueCabinetController::class, 'reserve_cabinet'])->name('reserve.cabinet');
