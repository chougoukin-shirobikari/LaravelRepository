<?php

use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'reply_id' => 1,
            'reply_no' => 1,
            'name' => 'name',
            'reply_time' => '',
            'reply_message' => 'message',
            'posting_id' => 1,
            'thread_id' => 1,
            'genre_id' => 1,
            'username' => 'username'
        ];

        DB::table('reply')->insert($param);

        $param = [
            'reply_id' => 2,
            'reply_no' => 1,
            'name' => 'name',
            'reply_time' => '',
            'reply_message' => 'message',
            'posting_id' => 2,
            'thread_id' => 1,
            'genre_id' => 1,
            'username' => 'username'
        ];

        DB::table('reply')->insert($param);

        $param = [
            'reply_id' => 3,
            'reply_no' => 1,
            'name' => 'name',
            'reply_time' => '',
            'reply_message' => 'message',
            'posting_id' => 7,
            'thread_id' => 4,
            'genre_id' => 2,
            'username' => 'username'
        ];

        DB::table('reply')->insert($param);
    }
}
