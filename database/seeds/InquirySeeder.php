<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'inquiry_id' => 1,
            'username' => 'user',
            'message' => 'message',
            'inquiry_time' => '2020-01-01',
            'user_id' => 1
        ];

        DB::table('inquiry')->insert($param);
    }
}
