<?php

use App\Http\Controllers\VirtualCardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('/generate', 'generate')->name('generate');

Route::get('/{slug}', [VirtualCardController::class, 'show'])->name('virtual-card.show'); // Should be the last route to let other routes take priority
