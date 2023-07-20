<?php

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

Route::get('/', [\App\Http\Controllers\Member\HomeController::class, 'index'])->name('home');
Route::match(['post', 'get'],'/login', [\App\Http\Controllers\Member\AuthController::class, 'login'])->name('member.login');
Route::match(['post', 'get'],'/register', [\App\Http\Controllers\Member\AuthController::class, 'register'])->name('member.register');
Route::get('/logout', [\App\Http\Controllers\Member\AuthController::class, 'logout'])->name('member.logout');
Route::get('/track', [\App\Http\Controllers\Member\HomeController::class, 'track'])->name('home.track');
