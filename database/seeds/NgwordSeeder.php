<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NgwordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'ngword_id' => 1,
            'ngword' => 'ngword'
        ];

        DB::table('ngword')->insert($param);

    }
}
