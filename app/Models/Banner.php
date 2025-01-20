<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Banner extends Model
{
    use HasFactory;

    public function registBanner($data){
        DB::table('banners')->insert([
            'image' => $data,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updateBanner($id, $data){
        DB::table('banners')->where('id', $id)->update([
            'image' => $data,
            'updated_at' => now(),
        ]);
    }

    public function deleteBanner($id)
    {
        // $image_path = 'public/' . str_replace('storage/', '', $banner->image);
        // if (\Storage::exists($image_path)){
        //     \Storage::delete($image_path);
        // }

        DB::table('banners')->where('id',$id)->delete();
    }
}
