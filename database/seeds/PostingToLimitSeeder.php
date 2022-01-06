<?php

use Illuminate\Database\Seeder;
use App\Posting;

class PostingToLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++){
            Posting::create([
                'posting_no' => $i,
                'name' => 'name',
                'message' => 'message',
                'writing_time' => '',
                'number_of_reply' => 0,
                'has_image' => 0,
                'genre_id' => 1,
                'thread_id' => 5,
                'username' => 'user',
                'posting_version' => 1
            ]);
        }

        $param = [
            'thread_id' => 5,
            'thread_title' => 'thread5',
            'created_time' => '',
            'number_of_posting' => 10,
            'genre_id' => 1,
            'username' => 'user',
            'thread_version' => 1
        ];

        DB::table('thread')->insert($param);
    }
}
