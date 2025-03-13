<?php

return [

    'defaults' => [
        'guard' => 'user', // ✅ ユーザーをデフォルトのガードにする
        'passwords' => 'users',
    ],

    'guards' => [
        'user' => [  // ユーザー用のガード
            'driver' => 'session',
            'provider' => 'users',
        ],


        'admin' => [  // 管理者用のガード
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'api' => [
            'driver' => 'sanctum',
            'provider' => 'users',
            'hash' => true,
        ],

        'admin-api' => [  // 管理者用の API ガード
            'driver' => 'sanctum',
            'provider' => 'admins',
            'hash' => true,
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [  // 管理者用のプロバイダ
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [  // 管理者用のパスワードリセット設定
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
