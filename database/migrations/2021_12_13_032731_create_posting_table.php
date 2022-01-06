<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posting', function (Blueprint $table) {
            $table->bigIncrements('posting_id');
            $table->integer('posting_no');
            $table->string('name');
            $table->string('message');
            $table->string('writing_time');
            $table->integer('number_of_reply');
            $table->integer('has_image');
            $table->integer('genre_id');
            $table->integer('thread_id');
            $table->string('username');
            $table->integer('posting_version');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posting');
    }
}
