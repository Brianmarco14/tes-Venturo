<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\DownloadFileController;

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

// Route::get('/', function () {
//     return view('app');
// });

Route::get('/', [ApiController::class, 'beranda'])->name('index');
Route::post('ambildata', [ApiController::class, 'ambilData'])->name('ambildata');

	
Route::get('/download', [DownloadFileController::class, 'download'])->name('download');
