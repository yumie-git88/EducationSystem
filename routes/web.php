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

    // ユーザー新規登録画面
    Route::get('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::post('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'register']);
    
    // ログイン画面
    Route::get('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'showLoginForm'])->name('show.login');
    Route::post('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'login']);

    Route::middleware('auth:user')->group(function () {
        // トップページ
        Route::get('/top', [App\Http\Controllers\User\TopController::class, 'showTop'])->name('show.top');

        // ログアウト
        Route::post('/logout', [App\Http\Controllers\User\Auth\LoginController::class,'logout'])->name('logout');

        // プロフィール設定画面
        Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'showProfileForm'])->name('show.profile');
        Route::post('/profile', [App\Http\Controllers\User\ProfileController::class, 'updateProfile'])->name('update.profile');

        // パスワード設定画面
        Route::get('/password', [App\Http\Controllers\User\PasswordController::class, 'showPasswordFrom'])->name('show.password.edit');
        Route::post('/password', [App\Http\Controllers\User\PasswordController::class, 'updatePassword'])->name('update.password');

        // 授業進捗画面
        Route::view('/progress', 'user.curriculum_progress')->name('show.progress');

        // 授業一覧画面
        Route::view('/curriculum_list', 'user.curriculum_list')->name('show.curriculum');
    });
});

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/top');

    // ユーザー新規登録画面
    Route::get('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::post('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);

    // ログイン画面
    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('show.login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        // トップページ
        Route::get('/top', [App\Http\Controllers\Admin\TopController::class, 'showTop'])->name('show.top');

        // ログアウト
        Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class,'logout'])->name('logout');

        // お知らせ一覧画面
        Route::get('/article_list', [App\Http\Controllers\Admin\ArticleController::class, 'showArticleList'])->name('show.article.list');
        Route::delete('/article_destroy/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'destroyArticle'])->name('article.destroy');

        // お知らせ新規登録画面
        Route::get('/article_create', [App\Http\Controllers\Admin\ArticleController::class, 'showArticleCreate'])->name('show.article.create');
        Route::post('/article_create', [App\Http\Controllers\Admin\ArticleController::class, 'storeArticleCreate'])->name('store.article.create');

        // お知らせ変更画面
        Route::get('/article_edit/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'showArticleEdit'])->name('show.article.edit');
        Route::post('/article_edit/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'updateArticleEdit'])->name('update.article.edit');

        // 授業一覧画面
        Route::view('/curriculum_list', 'admin.curriculum_list')->name('show.curriculum.list');

        // バナー設定画面
        Route::view('/banner_edit', 'admin.banner_edit')->name('show.banner.edit');
    });
});
