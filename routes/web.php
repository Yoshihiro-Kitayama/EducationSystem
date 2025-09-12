<?php
require __DIR__.'/auth.php';

use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DeliveryController;

// 管理者用のルート
Route::prefix('admin')->name('admin.')->group(function () {

    // カリキュラム作成（固定パスは先に書く）
    Route::get('/curriculums/create', [CurriculumController::class, 'create'])->name('curriculum.create');
    Route::post('/curriculums', [CurriculumController::class, 'store'])->name('curriculum.store');

    // カリキュラム編集
    Route::get('/curriculums/{curriculums_id}/edit', [CurriculumController::class, 'edit'])->name('curriculum.edit');
    Route::post('/curriculums/{curriculums_id}', [CurriculumController::class, 'update'])->name('curriculum.update');

    // Ajaxでの一覧取得
    Route::get('/curriculums/ajax/{grade_id}', [CurriculumController::class, 'ajaxList'])->name('curriculum.ajax');

    // カリキュラム一覧（可変パラメータは最後に書く）
    Route::get('/curriculums/{grade_id?}', [CurriculumController::class, 'index'])->name('curriculum.list');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::prefix('admin')->name('admin.')->group(function () {
    // 配信日時編集画面
    Route::get('/delivery/{curriculum_id}/edit', [DeliveryController::class, 'edit'])->name('delivery.edit');
});


Route::prefix('admin')->name('admin.')->group(function () {
    // 配信日時更新用ルート
    Route::post('/delivery/{curriculums_id}', [DeliveryController::class, 'update'])->name('delivery.update');
});