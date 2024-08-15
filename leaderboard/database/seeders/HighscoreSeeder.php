<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HighscoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $games = ['tetris', 'fortnite', 'minecraft', 'doom', 'mario kart'];

        foreach ($games as $game) {
            for ($i = 0; $i < 10; $i++) {
                DB::table('highscores')->insert([
                    'score' => rand(1, 500),
                    'player' => $faker->text(10),
                    'game' => $game
                ]);
            }
        }
    }
}
