<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('products')->insert([
                'name' => $faker->name(),
                'description' => $faker->paragraph(2),
                'price' => $faker->randomFloat(2),
                'image' => $faker->imageUrl(),
                'stock' => rand(0, 50)
            ]);
        }

    }
}
