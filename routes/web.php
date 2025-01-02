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

// Auth::routes();
// ユーザー時間割画面
// Route::group(['middleware' => 'auth'], function (){
    Route::get('user/curriculum_list',[App\Http\Controllers\User\CurriculumController::class,'showCurriculumList'])->name('show.curriculum');
    Route::get('user/top',[App\Http\Controllers\User\TopController::class,'showTop'])->name('show.top'); //仮のルーティングなためマージする際注意
// });
