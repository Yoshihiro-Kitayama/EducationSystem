<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $table = 'curriculum_progress';

    protected $fillable = [
        'curriculumus_id',
        'users_id',
        'clear_flg',
    ];

    // リレーション：カリキュラムとユーザー
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculumus_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
