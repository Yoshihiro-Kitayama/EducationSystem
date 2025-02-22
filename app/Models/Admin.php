<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory;

    /**
     * 認証ガードの指定
     */
    protected $guard = 'admin';

    /**
     * マスアサインメント可能な属性
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * 非表示にする属性
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * 型キャストの指定
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * パスワードを自動でハッシュ化
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::needsRehash($value) ? Hash::make($value) : $value,
        );
    }
}
