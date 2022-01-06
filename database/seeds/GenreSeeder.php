<?php

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
        $param = [
            'genre_id' => 1,
            'genre_title' => 'genre1'
        ];

        DB::table('genre')->insert($param);

        $param = [
            'genre_id' => 2,
            'genre_title' => 'genre2'
        ];

        DB::table('genre')->insert($param);
    }
}
