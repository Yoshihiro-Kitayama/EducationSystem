<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'name_kana',
        'email',
        'password',
        'profile_image', // ✅ プロフィール画像を保存可能にする
    ];

    protected $attributes = [
        'grade_id' => 1, // ✅ デフォルト学年を小学校1年生に設定
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ユーザーの現在の学年情報を取得
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    /**
     * ユーザーの授業クリア状況を取得
     */
    public function clearChecks()
    {
        return $this->hasMany(CurriculumClearCheck::class, 'users_id', 'id');
    }

    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image
            ? asset('storage/' . $this->profile_image) // ✅ `storage/` を追加
            : asset('images/default.png');
    }
    

}
