<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            ['genre' => 'Action'],
            ['genre' => 'Romance'],
            ['genre' => 'Adventure'],
            ['genre' => 'Comedy'],
            ['genre' => 'Drama'],
            ['genre' => 'Crime'],
            ['genre' => 'Fantasy'],
            ['genre' => 'Thriller'],
            ['genre' => 'Family'],
            ['genre' => 'History'],
            ['genre' => 'Horror']
        ]);
    }
}
