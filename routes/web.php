<?php

use App\Http\Controllers\File\FileController;
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
    return view('welcome');
});

Route::get('/file', [FileController::class, 'index']);
Route::get('/file/list', [FileController::class, 'list']);
Route::get('/file/{filename}', [FileController::class, 'show']);
Route::post('/file', [FileController::class, 'store'])->name('file.store');
