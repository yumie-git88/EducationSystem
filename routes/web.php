<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DeliveryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//新規登録
Route::get('/curriculum_create', [CurriculumController::class, 'newList'])->name('curriculum_create');
Route::post('/curriculum_create', [CurriculumController::class, 'newList'])->name('curriculum_create.data');

//サイドバーの表示
Route::get('/grade/{grade_id}/courses', [CurriculumController::class, 'coursesByGrade'])->name('grade_courses');
Route::get('/curriculum_list', [CurriculumController::class, 'list'])->name('curriculum_list');


//授業内容編集へ移動・情報登録
Route::get('/curriculum/{id}/edit', [CurriculumController::class, 'edit'])->name('curriculum_edit');
Route::post('/curriculum/{id}/update', [CurriculumController::class, 'update'])->name('curriculum_update');


//配信日時設定へ移動
Route::get('/curriculum/{id}/delivery', [DeliveryController::class, 'delivery'])->name('delivery');
Route::post('/curriculum/{id}/delivery/save', [DeliveryController::class, 'saveDeliveryTimes'])->name('save_delivery_times');

//学年に応じた授業表示
Route::get('/grade/{grade_id}/courses', [CurriculumController::class, 'showCourses'])->name('grade_courses');
//一覧表示
Route::get('/curriculum_list', [CurriculumController::class, 'list'])->name('curriculum_list');