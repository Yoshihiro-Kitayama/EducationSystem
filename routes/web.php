<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\User\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\User\DeliveryController;


// ユーザー用ルート (user)
Route::prefix('user')->name('user.')->group(function () {

    // 未認証ユーザー向け (ゲスト)
    Route::middleware('guest:user')->group(function () {
        Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [UserLoginController::class, 'login']);
        Route::get('/register', [UserRegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [UserRegisterController::class, 'register']);
    });

    // 認証済みユーザー向け (ログイン必須)
    Route::middleware('auth:user')->group(function () {
        Route::get('/top', function () {
            return view('user.top');
        })->name('top');

        Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');

        // プロフィール関連
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/password/change', [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
        Route::post('/profile/password/update', [ProfileController::class, 'changePassword'])->name('password.update');

        // 授業進捗
        Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');

        // 記事（お知らせ）
        Route::get('/article/{id}', [UserArticleController::class, 'user_article'])->name('article.article');

        // ユーザー配信ページ
        Route::get('/delivery/{curriculum}', [DeliveryController::class, 'show'])->name('curriculum.delivery');
    });

});


// 管理者用ルート (admin)
Route::prefix('admin')->name('admin.')->group(function () {

    // 未認証管理者向け (ゲスト)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login']);
        Route::get('/register', [AdminRegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AdminRegisterController::class, 'register']);
    });

    // 認証済み管理者向け (ログイン必須)
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

        // 管理者ダッシュボード
        Route::get('/top', function () {
            return view('admin.top');
        })->name('dashboard');

        // 記事管理
        Route::prefix('article')->name('article.')->group(function () {
            Route::get('/list', [AdminArticleController::class, 'list'])->name('list');
            Route::get('/create', [AdminArticleController::class, 'create'])->name('create');
            Route::post('/store', [AdminArticleController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [AdminArticleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminArticleController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminArticleController::class, 'destroy'])->name('destroy');
        });
    });

});
