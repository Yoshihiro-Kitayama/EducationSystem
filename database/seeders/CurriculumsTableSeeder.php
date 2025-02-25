<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use Illuminate\Database\Seeder;

class CurriculumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curriculum::create([
            'title' => 'テスト',
            'thumbnail' => 'storage/app/public/images/banner/image.png',
            'description' => 'これはテストデータです。',
            'video_url' => 'https://www.youtube.com/watch?v=XWEyB2SmuDg',
        ]);
    }
}
