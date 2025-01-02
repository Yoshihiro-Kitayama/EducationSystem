<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $numberOfRecords = 100;

        for ($i = 1; $i <= $numberOfRecords; $i++){
            $delivery_from = $faker->dateTimeBetween('2024-04-01', '2024-12-31');
            $delivery_to = $faker->dateTimeBetween($delivery_from, $delivery_from->modify('+3 months'));
            DB::table('delivery_times')->insert([
                'curriculums_id' => $faker->numberBetween(1,100),
                'delivery_from' => $delivery_from,
                'delivery_to' => $delivery_to,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
