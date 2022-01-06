<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreControllerTest extends TestCase
{
    use RefreshDataBase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');

    }

    public function testShowGenre(): void
    {
        $response = $this->withSession(['username' => 'admin'])->get(url('genre/showGenre'));
        $response->assertStatus(200);
        $response->assertViewIs('genre');
        $response->assertSeeText('genre1');
    }

    public function testToGenreForm(): void
    {
        $response = $this->withSession(['username' => 'admin'])->get(url('genre/toGenreForm'));
        $response->assertStatus(200);
        $response->assertViewIs('genreForm');
        $response->assertSeeText('ジャンルの追加');
    }

    public function testCreateGenre(): void
    {
        $data = [
            'genre_title' => 'genre'
        ];

        $response = $this->withSession(['username' => 'admin'])->post(url('genre/createGenre'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect('genre/showGenre');
        $this->assertDatabaseHas('genre', $data);


    }

    public function testDeleteGenre()
    {
        $genre = [
            'genre_id' => 2,
            'genre_title' => 'genre2'
        ];

        $thread = [
            'thread_id' => 4,
            'thread_title' => 'thread4',
            'created_time' => '',
            'number_of_posting' => 1,
            'genre_id' => 2,
            'username' => 'user'
        ];

        $posting = [
            'posting_id' => 7,
            'posting_no' => 1,
            'name' => 'name',
            'message' => 'message',
            'writing_time' => '',
            'number_of_reply' => 1,
            'has_image'  => 1,
            'genre_id' => 2,
            'thread_id' => 4,
            'username' => 'user'
        ];

        $image = [
            'image_id' => 2,
            'image_name' => 'image.jpg',
            'created_time' => '',
            'posting_id' => 7,
            'thread_id' => 4,
            'genre_id' => 2
        ];

        $reply = [
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

        $this->assertDatabaseHas('genre', $genre);
        $this->assertDatabaseHas('thread', $thread);
        $this->assertDatabaseHas('posting', $posting);
        $this->assertDatabaseHas('image', $image);
        $this->assertDatabaseHas('reply', $reply);
        $response = $this->withSession(['username' => 'admin'])->delete(url('genre/deleteGenre', 2));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('genre', $genre);
        $this->assertDatabaseMissing('thread', $thread);
        $this->assertDatabaseMissing('posting', $posting);
        //$this->assertDatabaseMissing('image', $image);
        $this->assertDatabaseMissing('reply', $reply);
    }

}
