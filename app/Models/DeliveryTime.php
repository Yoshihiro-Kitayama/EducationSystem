<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;
    protected $fillable = ['curriculums_id', 'delivery_from', 'delivery_to'];

    // リレーション: DeliveryTimeは1つのCurriculumに属する
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }

    protected $casts = [
        'delivery_from' => 'datetime',
        'delivery_to' => 'datetime',
    ];
    
}
