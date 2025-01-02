<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        public function grade(){
            return $this->belongsTo(Grade::class, 'grade_id','id');
        }

        public function CurriculumClearChecks(){
            return $this->hasMany(CurriculumClearCheck::class, 'user_id');
        }
        
        //受講中のカリキュラム、クリアしたカリキュラムの取得
        public function getCurriculumClearOrAttendance(){
        //１現在のユーザー情報から、grade_idを取得、現在の学年を特定
        $user_grade_id = $this->grade_id;

        //２ユーザーIDを元に、grades_clear_checksテーブルからclear_flgが１のgrade_idを取得。
        $user_clear_flgs = CurriculumClearCheck::where('users_id',$this->id)
            ->where('clear_flg','1')
            ->pluck('grade_id');

        //１と２から、現在受講中の学年と、クリアしている学年を返り値で返す。
        return[
            'current_grade_id' => $user_grade_id,
            'user_clear_flgs' => $user_clear_flgs
        ];
    }

}
