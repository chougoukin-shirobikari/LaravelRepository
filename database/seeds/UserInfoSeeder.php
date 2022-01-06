<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'username' => 'admin',
            'password' => Hash::make('password'),
            'gender' => '男性',
            'role' => 'ADMIN',
            'last_writing_time' => '2021-07-22'
        ];

        DB::table('user_info')->insert($param);

        $param = [
            'user_id' => 2,
            'username' => 'user',
            'password' => Hash::make('password'),
            'gender' => '男性',
            'role' => 'USER',
            'last_writing_time' => '2021-07-22'
        ];

        DB::table('user_info')->insert($param);

        $param = [
            'user_id' => 3,
            'username' => 'ghostuser',
            'password' => Hash::make('password'),
            'gender' => '男性',
            'role' => 'USER',
            'last_writing_time' => '2021-07-22'
        ];

        DB::table('user_info')->insert($param);


    }
}
