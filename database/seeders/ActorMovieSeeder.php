<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActorMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actor_movie')->insert([
            'movie_id' => 1,
            'actor_id' => 1,
            'character_name' => 'Shuri'
        ]);
        DB::table('actor_movie')->insert([
            'movie_id' => 1,
            'actor_id' => 2,
            'character_name' => 'Nakia'
        ]);
        DB::table('actor_movie')->insert([
            'movie_id' => 1,
            'actor_id' => 3,
            'character_name' => 'Okoye'
        ]);
        DB::table('actor_movie')->insert([
            'movie_id' => 1,
            'actor_id' => 4,
            'character_name' => "M'Baku"
        ]);
        DB::table('actor_movie')->insert([
            'movie_id' => 2,
            'actor_id' => 5,
            'character_name' => 'Chef Slowik'
        ]);
        DB::table('actor_movie')->insert([
            'movie_id' => 2,
            'actor_id' => 6,
            'character_name' => 'Margot'
        ]);
        DB::table('actor_movie')->insert([
            'movie_id' => 2,
            'actor_id' => 7,
            'character_name' => 'Tyler'
        ]);
        DB::table('actor_movie')->insert([
            'movie_id' => 2,
            'actor_id' => 8,
            'character_name' => "Elsa"
        ]);
    }
}
