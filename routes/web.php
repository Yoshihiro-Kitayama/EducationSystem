<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\TopController;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\User\DeliveryController;
use App\Http\Controllers\User\ArticleController;


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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('user')->namespace('User')->name('user.')->group(function () {

        // 認証処理を通過後、TopControllerのindexメソッドを呼び出す
        Route::get('/top', [TopController::class, 'showTop'])->name('show.top');
        Route::get('/delivery/{grade_id}', [DeliveryController::class, 'showDelivery'])->name('show.delivery');
        Route::post('/update-progress', [DeliveryController::class, 'updateProgress'])->name('curriculum.complete');
        Route::get('/article', [ArticleController::class, 'showArticle'])->name('show.article');

});