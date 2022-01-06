<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'posting_id' => 1,
            'posting_no' => 1,
            'name' => 'name1',
            'message' => 'message1',
            'writing_time' => '',
            'number_of_reply' => 1,
            'has_image'  => 1,
            'genre_id' => 1,
            'thread_id' => 1,
            'username' => 'user',
            'posting_version' => 1
        ];

        DB::table('posting')->insert($param);

        $param = [
            'posting_id' => 2,
            'posting_no' => 2,
            'name' => 'name2',
            'message' => 'message2',
            'writing_time' => '',
            'number_of_reply' => 1,
            'has_image'  => 0,
            'genre_id' => 1,
            'thread_id' => 1,
            'username' => 'user',
            'posting_version' => 1
        ];

        DB::table('posting')->insert($param);

        $param = [
            'posting_id' => 3,
            'posting_no' => 3,
            'name' => 'name3',
            'message' => 'message3',
            'writing_time' => '',
            'number_of_reply' => 1,
            'has_image'  => 0,
            'genre_id' => 1,
            'thread_id' => 1,
            'username' => 'user',
            'posting_version' => 1
        ];

        DB::table('posting')->insert($param);

        $param = [
            'posting_id' => 4,
            'posting_no' => 1,
            'name' => 'name1',
            'message' => 'message',
            'writing_time' => '',
            'number_of_reply' => 0,
            'has_image'  => 0,
            'genre_id' => 1,
            'thread_id' => 2,
            'username' => 'user',
            'posting_version' => 1
        ];

        DB::table('posting')->insert($param);

        $param = [
            'posting_id' => 5,
            'posting_no' => 2,
            'name' => 'name2',
            'message' => 'message',
            'writing_time' => '',
            'number_of_reply' => 0,
            'has_image'  => 0,
            'genre_id' => 1,
            'thread_id' => 2,
            'username' => 'user',
            'posting_version' => 1
        ];

        DB::table('posting')->insert($param);

        $param = [
            'posting_id' => 6,
            'posting_no' => 1,
            'name' => 'name',
            'message' => 'message',
            'writing_time' => '',
            'number_of_reply' => 0,
            'has_image'  => 0,
            'genre_id' => 1,
            'thread_id' => 3,
            'username' => 'user',
            'posting_version' => 1
        ];

        DB::table('posting')->insert($param);

        $param = [
            'posting_id' => 7,
            'posting_no' => 1,
            'name' => 'name',
            'message' => 'message',
            'writing_time' => '',
            'number_of_reply' => 1,
            'has_image'  => 1,
            'genre_id' => 2,
            'thread_id' => 4,
            'username' => 'user',
            'posting_version' => 1
        ];

        DB::table('posting')->insert($param);


    }
}
