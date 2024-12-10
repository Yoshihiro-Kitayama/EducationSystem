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

Route::post('/curriculum_edit/{grade_id}/update', [CurriculumController::class, 'update'])->name('curriculum.update');
Route::get('/curriculum_list/{grade_id}', [CurriculumController::class, 'index'])->name('show.curriculum.list');
Route::get('/curriculum_edit/{id}', [CurriculumController::class, 'edit'])->name('show.curriculum.edit');
Route::get('/delivery/{grade_id}/edit', [DeliveryController::class, 'edit'])->name('delivery.edit');
Route::post('/delivery/{grade_id}/update', [DeliveryController::class, 'update'])->name('delivery.update');