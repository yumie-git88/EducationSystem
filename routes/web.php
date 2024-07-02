<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::redirect('/', '/user/top');
    // ユーザー新規登録
    Route::view('/register', 'user.auth.register')->name('auth.register');
    Route::post('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'register']);
    // ログイン
    Route::view('/login', 'user.auth.login')->name('auth.login');
    Route::post('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'login']);
    // ログアウト
    Route::post('/logout', [App\Http\Controllers\User\Auth\LoginController::class,'logout'])->name('logout');
    // トップページ
    Route::view('/top', 'user.top')->middleware('auth:user')->name('top');
    // プロフィール設定ページ
    Route::view('/profile_edit', 'user.profile_edit')->name('profile_edit');
});

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/top');
    // ユーザー新規登録
    Route::view('/register', 'admin.auth.register')->name('auth.register');
    Route::post('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);
    // ログイン
    Route::view('/login', 'admin.auth.login')->name('auth.login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
    // ログアウト
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class,'logout'])->name('logout');
    // トップページ
    Route::view('/top', 'admin.top')->middleware('auth:admin')->name('top');
});
