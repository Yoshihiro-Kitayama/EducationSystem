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

Route::prefix('user')->namespace('User')->name('user.')->group(function(){
    Route::group(['middleware' => 'auth'], function (){
           Route::get('curriculum_list',[App\Http\Controllers\User\CurriculumController::class,'showCurriculumList'])->name('show.curriculum');
    });
});

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function(){
    Route::get('login',[App\Http\Controllers\Admin\Auth\LoginController::class,'showLoginForm'])->name('show.login');
    Route::post('login',[App\Http\Controllers\Admin\Auth\LoginController::class,'login'])->name('login.submit');
    Route::post('logout',[App\Http\Controllers\Admin\Auth\LoginController::class,'logout'])->name('logout');
    Route::get('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::post('register',[App\Http\Controllers\Admin\Auth\RegisterController::class, 'register'])->name('register.submit');
    Route::get('top', [App\Http\Controllers\Admin\TopController::class, 'showTop'])->name('show.top');
    Route::group(['middleware' => 'auth'], function (){

    });
});
Auth::routes();
