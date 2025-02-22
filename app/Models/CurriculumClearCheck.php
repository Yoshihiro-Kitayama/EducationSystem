<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumClearCheck extends Model
{
    use HasFactory;

    protected $table = 'grades_clear_checks'; // テーブル名を明示

    protected $fillable = [
        'users_id',
        'grade_id',
        'clear_flg',
    ];

    /**
     * ユーザーとのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * 学年（grade）とのリレーション
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
