<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CurriculumClearCheck extends Model
{
    use HasFactory;

    protected $table = 'grades_clear_checks';

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

}
