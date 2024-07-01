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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->namespace('User')->name('user.')->group(function () {
    Route::view('/register', 'user.auth.register')->name('auth.register');
    Route::post('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'register']);
    Route::view('/login', 'user.auth.login')->name('auth.login');
    Route::post('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'login']);
    Route::view('/top', 'user.top')->middleware('auth:user')->name('top');
    Route::post('/logout', [App\Http\Controllers\User\Auth\LoginController::class,'logout'])->name('logout');
});


Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::view('/register', 'admin.auth.register')->name('auth.register');
    Route::post('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);
    Route::view('/login', 'admin.auth.login')->name('auth.login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
    Route::view('/top', 'admin.top')->middleware('auth:admin')->name('top');
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class,'logout'])->name('logout');
});
