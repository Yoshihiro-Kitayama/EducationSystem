<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++){
            DB::table('curriculums')->insert([
                'title' => $faker->sentence(3),
                'thumbnail' => $faker->imageUrl(640, 480, 'education', true, 'Faker'),
                'description' => $faker->paragraph(),
                'video_url' => $faker->url(),
                'alway_delivery_flg' => $faker->boolean() ? 1 : 0,
                'grade_id' => $faker->numberBetween(1,12),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
