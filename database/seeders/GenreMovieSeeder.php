<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genre_movie')->insert([
            ['movie_id' => 1, 'genre_id' => 1],
            ['movie_id' => 1, 'genre_id' => 3],
            ['movie_id' => 1, 'genre_id' => 5],
        ]);
        DB::table('genre_movie')->insert([
            ['movie_id' => 2, 'genre_id' => 4],
            ['movie_id' => 2, 'genre_id' => 8],
            ['movie_id' => 2, 'genre_id' => 11],
        ]);
    }
}
