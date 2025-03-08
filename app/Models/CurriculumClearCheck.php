<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumClearCheck extends Model
{
    use HasFactory;

    protected $table = 'curriculum_progress'; // 正しいテーブル名を指定


    protected $fillable = [
        'users_id',
        'grade_id',
        'curriculums_id', // 追加
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

    /**
 * カリキュラムとのリレーション
 */
public function curriculum()
{
    return $this->belongsTo(Curriculum::class, 'curriculums_id');
}

}
