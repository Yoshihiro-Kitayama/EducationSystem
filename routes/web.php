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



// ユーザー認証ルート
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('guest:user')->group(function () {
        Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [UserLoginController::class, 'login']);
        Route::get('/register', [UserRegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [UserRegisterController::class, 'register']);
    });

    Route::middleware('auth:user')->group(function () {
        Route::get('/top', function () {
            return view('user.top');  // ✅ このルートを追加！
        })->name('top');

        Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');
    });
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
    });
});


// 管理者認証ルート
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login']);
        Route::get('/register', [AdminRegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AdminRegisterController::class, 'register']);
    });



    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    });
});

// 管理者用ダッシュボード
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/top', function () {
        return view('admin.top'); // 適切な Blade ファイルを指定
    })->name('dashboard');
});



// 管理者用お知らせ関連ルート
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('article/list', [AdminArticleController::class, 'list'])->name('article.list'); // ✅ 記事一覧
    Route::get('article/create', [AdminArticleController::class, 'create'])->name('article.create'); // ✅ 記事作成
    Route::post('article/store', [AdminArticleController::class, 'store'])->name('article.store'); // ✅ 記事保存
    Route::get('article/{id}/edit', [AdminArticleController::class, 'edit'])->name('article.edit');
    Route::put('article/{id}', [AdminArticleController::class, 'update'])->name('article.update');
    Route::delete('article/{id}', [AdminArticleController::class, 'destroy'])->name('article.destroy');
    
});



// ユーザープロフィール関連ルート
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('auth:user')->group(function () {
        Route::get('/profile/password/change', [ProfileController::class, 'showChangePasswordForm'])
            ->name('password.change');

        Route::post('/profile/password/update', [ProfileController::class, 'changePassword'])
            ->name('password.update');

//ユーザーお知らせページ
Route::get('/article/{id}', [UserArticleController::class, 'user_article'])->name('article.article');

    });
});
