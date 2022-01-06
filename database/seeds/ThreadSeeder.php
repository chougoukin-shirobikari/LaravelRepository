<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'thread_id' => 1,
            'thread_title' => 'thread1',
            'created_time' => '',
            'number_of_posting' => 2,
            'genre_id' => 1,
            'username' => 'user',
            'thread_version' => 1
        ];

        DB::table('thread')->insert($param);

        $param = [
            'thread_id' => 2,
            'thread_title' => 'thread2',
            'created_time' => '',
            'number_of_posting' => 2,
            'genre_id' => 1,
            'username' => 'user',
            'thread_version' => 1
        ];

        DB::table('thread')->insert($param);

        $param = [
            'thread_id' => 3,
            'thread_title' => 'thread3',
            'created_time' => '',
            'number_of_posting' => 1,
            'genre_id' => 1,
            'username' => 'user',
            'thread_version' => 1
        ];

        DB::table('thread')->insert($param);

        $param = [
            'thread_id' => 4,
            'thread_title' => 'thread4',
            'created_time' => '',
            'number_of_posting' => 1,
            'genre_id' => 2,
            'username' => 'user',
            'thread_version' => 1
        ];

        DB::table('thread')->insert($param);
    }
}
