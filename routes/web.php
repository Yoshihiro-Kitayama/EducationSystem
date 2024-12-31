<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\DeliveryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| 管理者用のルートを 'admin' プレフィックスでグループ化
|
*/

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    // カリキュラム関連ルート
    Route::get('/curriculum_list/{grade_id?}', [CurriculumController::class, 'index'])->name('curriculum.list');
    Route::get('/curriculum/ajax/{grade_id}', [CurriculumController::class, 'ajaxList'])->name('curriculum.ajax');
    Route::get('/curriculum_edit/{curriculums_id}', [CurriculumController::class, 'edit'])->name('curriculum.edit');
    Route::post('/curriculum_edit/{curriculums_id}', [CurriculumController::class, 'update'])->name('curriculum.update');
    Route::get('/curriculum_create', [CurriculumController::class, 'create'])->name('curriculum.create');
    Route::post('/curriculum_create', [CurriculumController::class, 'store'])->name('curriculum.store');
    
    // 配信関連ルート
    Route::get('/delivery_edit/{curriculums_id}', [DeliveryController::class, 'edit'])->name('delivery.edit');
    Route::post('/delivery_edit/{curriculums_id}', [DeliveryController::class, 'update'])->name('delivery.update');
});

