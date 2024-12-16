<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DeliveryController;

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

Route::get('/curriculum_list/{grade_id?}', [CurriculumController::class, 'index'])->name('show.curriculum.list');
Route::get('/curriculum_edit/{curriculums_id}', [CurriculumController::class, 'edit'])->name('show.curriculum.edit');
Route::post('/curriculum_edit/{curriculums_id}', [CurriculumController::class, 'update'])->name('curriculum.update');
Route::get('/delivery_edit/{curriculums_id}', [DeliveryController::class, 'edit'])->name('delivery.edit');
Route::post('/delivery_edit/{curriculums_id}', [DeliveryController::class, 'update'])->name('delivery.update');
Route::get('/curriculum_create', [CurriculumController::class, 'create'])->name('show.curriculum.create');
Route::post('/curriculum_create', [CurriculumController::class, 'store'])->name('curriculum.store');

