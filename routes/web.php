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
Route::match(['post', 'get'], '/login', [\App\Http\Controllers\Member\AuthController::class, 'login'])->name('member.login');
Route::match(['post', 'get'], '/register', [\App\Http\Controllers\Member\AuthController::class, 'register'])->name('member.register');
Route::get('/logout', [\App\Http\Controllers\Member\AuthController::class, 'logout'])->name('member.logout');

Route::match(['post', 'get'], '/login-admin', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login');
Route::get('/logout-admin', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
Route::get('/track', [\App\Http\Controllers\Member\HomeController::class, 'track'])->name('home.track');

Route::group(['middleware' => 'auth:web'], function () {
    Route::post('/', [\App\Http\Controllers\Member\HomeController::class, 'index'])->name('ticket.post');

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'pengguna'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('admin.pengguna');
        Route::post('/{id}', [\App\Http\Controllers\Admin\PenggunaController::class, 'patch'])->name('admin.pengguna.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\PenggunaController::class, 'destroy'])->name('admin.pengguna.delete');
    });

    Route::group(['prefix' => 'ticket-baru'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\TicketController::class, 'ticket_baru'])->name('admin.ticket.baru');
        Route::post('/{id}', [\App\Http\Controllers\Admin\PenggunaController::class, 'patch'])->name('admin.pengguna.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\PenggunaController::class, 'destroy'])->name('admin.pengguna.delete');
    });
});
