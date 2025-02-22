<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Grade が持つカリキュラムを取得
    public function curriculums()
    {
        return $this->hasMany(Curriculum::class, 'grade_id');
    }
}
