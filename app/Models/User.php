<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'name_kana',
        'email',
        'password',
        'profile_image',
    ];

    protected $attributes = [
        'grade_id' => 1,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function clearChecks()
    {
        return $this->hasMany(CurriculumClearCheck::class, 'users_id', 'id');
    }

    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image
            ? asset('storage/' . $this->profile_image)
            : asset('images/default.png');
    }

    /**
     * プロフィールを更新する（トランザクションを利用）
     */
    public function updateProfile(array $data)
    {
        return DB::transaction(function () use ($data) {
            if (isset($data['profile_image'])) {
                if ($this->profile_image) {
                    Storage::delete('public/' . $this->profile_image);
                }
                $this->profile_image = $data['profile_image']->store('images/profile', 'public');
            }

            if (!empty($data['name'])) {
                $this->name = $data['name'];
            }

            if (!empty($data['name_kana'])) {
                $this->name_kana = $data['name_kana'];
            }

            if (!empty($data['email'])) {
                $this->email = $data['email'];
            }

            $this->save();
        });
    }

    /**
     * パスワードを変更する（トランザクションを利用）
     */
    public function changePassword(string $newPassword)
    {
        return DB::transaction(function () use ($newPassword) {
            $this->password = Hash::make($newPassword);
            $this->save();
        });
    }
}
