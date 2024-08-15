<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FungusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++ ) {
            DB::table('fungi')->insert([
                'species' => $faker->name(),
                'averageHeight' => $faker->randomFloat(2, 1, 10),
                'colour' => $faker->colorName()
            ]);
        }
    }
}
