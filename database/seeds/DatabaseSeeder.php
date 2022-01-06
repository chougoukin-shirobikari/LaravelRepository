<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(ThreadSeeder::class);
        $this->call(PostingSeeder::class);
        $this->call(ReplySeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(NgwordSeeder::class);
        $this->call(UserInfoSeeder::class);
        $this->call(InquirySeeder::class);
    }
}
