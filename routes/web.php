<?php

use App\Http\Controllers\JawabanController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [JawabanController::class, 'satu']);
Route::get('/dua', [JawabanController::class, 'dua']);
Route::get('/empat', [JawabanController::class, 'empat']);
Route::post('/empat-simpan', [JawabanController::class, 'simpan']);

