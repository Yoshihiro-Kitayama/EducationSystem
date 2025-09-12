<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            ['name' => '小学校1年生'],
            ['name' => '小学校2年生'],
            ['name' => '小学校3年生'],
            ['name' => '小学校4年生'],
            ['name' => '小学校5年生'],
            ['name' => '小学校6年生'],
            ['name' => '中学校1年生'],
            ['name' => '中学校2年生'],
            ['name' => '中学校3年生'],
            ['name' => '高校1年生'],
            ['name' => '高校2年生'],
            ['name' => '高校3年生'],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}