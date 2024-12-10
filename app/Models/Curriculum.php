<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{

    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'video_url',
        'alaways_delivery_flg',
        'grade_id',
    ];
    protected $table = 'curriculums';


    // リレーション: Curriculumは複数のDeliveryTimeを持つ
    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }
    // 学年とのリレーション (多対1)
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
