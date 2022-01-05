<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', 'WebController@index')->name('main');

Route::post('/users', [UserController::class, 'store'])->name('insert_user');
Route::put('/users/{id}', [UserController::class, 'update'])->name('update_user');
Route::get('/users/{id}', [UserController::class, 'show'])->name('get_one');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('delete_user');
Route::get('/users', [UserController::class, 'index'])->name('get_all');
