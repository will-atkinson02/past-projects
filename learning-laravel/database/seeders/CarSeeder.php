<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gives us access to faker - a tool for generating dummy data
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('cars')->insert([
                'make' => $faker->company(),
                'model' => $faker->sentence(),
                'description' => $faker->paragraph(2),
                'price' => $faker->randomFloat(2),
                'seats' => rand(2, 7),
                'owned' => $faker->boolean()
            ]);
        }
    }
}
