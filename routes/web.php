<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // 追記
use App\Http\Controllers\User; // 追記
use App\Http\Controllers\Admin; // 追記

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('user.auth.login');
});

// 以下ユーザーページ追記
Route::get('login', [App\Http\Controllers\User\Auth\LoginController::class, 'index'])->name('login.index');
Route::group(['middleware' => ['web']], function () {
  Route::post('login', [App\Http\Controllers\User\Auth\LoginController::class, 'login'])->name('login.login');
  Route::get('logout', [App\Http\Controllers\User\Auth\LoginController::class, 'logout'])->name('login.logout');
});

Route::get('register', [App\Http\Controllers\User\Auth\RegisterController::class, 'showRegisterForm'])->name('register'); //ユーザー新規登録画面

Route::prefix('user')->middleware('auth:users')->group(function () {
  Route::get('/', [App\Http\Controllers\User\TopController::class, 'showTop'])->name('user.top');
  Route::get('curriculum_list', [App\Http\Controllers\User\CurriculumController::class, 'showCurriculumList'])->name('show.curriculum'); //時間割画面
  Route::get('progress', [App\Http\Controllers\User\ProgressController::class, 'showProgress'])->name('show.progress'); //授業進捗画面
  Route::get('profile', [App\Http\Controllers\User\ProfileController::class, 'showProfileForm'])->name('show.profile'); //プロフィール設定画面
  Route::get('article/{id}', [App\Http\Controllers\User\ArticleController::class, 'showArticle'])->name('show.article'); //お知らせ詳細ページ
  Route::get('delivery/{id}', [App\Http\Controllers\User\DeliveryController::class, 'showDelivery'])->name('show.delivery'); //配信ページ
});

// 以下管理ページ追記
Route::prefix('admin')->middleware('auth:admins')->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'index'])->name('admin.login.index');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login.login');
    Route::get('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.login.logout');

    // Route::get('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'index'])->name('admin.register');
    
    Route::get('/', [App\Http\Controllers\Admin\TopController::class, 'index'])->name('admin.top'); //ログイン後のページ
});
