<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'image_id' => 1,
            'image_name' => 'image.jpg',
            'created_time' => '',
            'posting_id' => 1,
            'thread_id' => 1,
            'genre_id' => 1
        ];

        DB::table('image')->insert($param);

        $param = [
            'image_id' => 2,
            'image_name' => 'image.jpg',
            'created_time' => '',
            'posting_id' => 7,
            'thread_id' => 4,
            'genre_id' => 2
        ];

        DB::table('image')->insert($param);
    }
}
