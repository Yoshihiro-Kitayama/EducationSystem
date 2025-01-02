<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class Curriculum extends Model
{
    use HasFactory;

    protected $table ='curriculums';


    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function deliveryTimes(){
        return $this->hasMany(DeliveryTime::class, 'curriculums_id','id');
    }
    
    // 現在の月のカリキュラムを取得するメソッド
    public static function getCurriculumList($grade_id = null, $month_start, $month_end){
        $grade_id = $grade_id ?? 1; //grade_idに引数で代入。ない場合（初期値は1）

        //現在の学年と一致する＋常時公開フラグがオンのカリキュラムを取得
        $curriculums_always = Curriculum::with('deliveryTimes')
            ->where('grade_id',$grade_id)
            ->where('alway_delivery_flg',1)
            ->get();

        //表示している月の範囲内の動画をwhereHasを使い、現在の学年と一致する＋deliverytimesテーブルから範囲内のカリキュラムを取得。
        $curriculums_current_month = Curriculum::with('deliveryTimes')
            ->where('grade_id',$grade_id)
            ->whereHas('deliveryTimes', function ($q) use($month_start, $month_end){
                $q->where('delivery_from', '<=', $month_end)
                ->where('delivery_to', '>=', $month_start);
            })->get();
        
        //margeして全てのカリキュラムを取得する。
        $curriculums = $curriculums_always->merge($curriculums_current_month)->unique('id');
        
        return $curriculums;
    }

    // 配信期間を日付時間度に表示するためのメソッド
    public function getAdjustedDeliveryTimes($month_start, $month_end)
    {
        $grouped_times = [];

        foreach ($this->deliveryTimes as $deliveryTime) {
            $delivery_from = Carbon::parse($deliveryTime->delivery_from);
            $delivery_to = Carbon::parse($deliveryTime->delivery_to);

            if($delivery_from->lte($month_end) && $delivery_to->gte($month_start)) {
                $adjusted_from = $delivery_from->greaterThan($month_start) ? $delivery_from : $month_start;
                $adjusted_to = $delivery_to->lessThan($month_end) ? $delivery_to : $month_end;

                $day_key = $adjusted_from->format('n月j日');

                // 日付ごとに時間をまとめる
                if (!isset($grouped_times[$day_key])) {
                    $grouped_times[$day_key] = [];
                }

                $grouped_times[$day_key][] = [
                    'from_time' => $adjusted_from->format('G時i分'),
                    'to_time' => $adjusted_to->format('G時i分'),
                ];
            }
        }
        return $grouped_times;
    }
    // ビューで配信期間を表示するためのメソッド
    public static function getDeliveryTimesGrouped($curriculums, $month_start, $month_end)
    {
        $grouped = [];
        foreach ($curriculums as $curriculum) {
            $grouped[$curriculum->id] = $curriculum->getAdjustedDeliveryTimes($month_start, $month_end);
        }
        return $grouped;
    }
    
}
