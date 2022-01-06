<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Posting;
use Tests\TestCase;

class ShowThreadControllerTest extends TestCase
{
    use RefreshDataBase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');

    }

    public function testShowThreadOrderByCreatedTime(): void
    {
        $response = $this->withSession(['username' => 'admin'])->get(url('thread/showThread/orderByCreatedTime', 1));
        $response->assertStatus(200);
        $response->assertViewIs('component.threadComponent');
        $response->assertSeeTextInOrder(['thread3', 'thread2', 'thread1']);
    }

    public function testShowThreadOrderByNumberOfPosting(): void
    {
        $response = $this->withSession(['username' => 'admin'])->get(url('thread/showThread/orderByNumberOfPosting', 1));
        $response->assertStatus(200);
        $response->assertViewIs('component.threadComponent');
        $response->assertSeeTextInOrder(['thread1', 'thread3']);
    }

    public function testShowSearchedThread(): void
    {
        $keyword = 'thread1';
        $response = $this->withSession(['username' => 'admin'])->call('GET', url('thread/showSearchedThread', 1), ['keyword' => $keyword]);
        $response->assertStatus(200);
        $response->assertViewIs('component.threadComponent');
        $response->assertSeeText('thread1');
        $response->assertDontSeeText('thread2');
        $response->assertDontSeeText('thread3');
    }

    public function testShowSearchedThreadOrderByCreatedTime(): void
    {
        $keyword = 'thread';
        $response = $this->withSession(['username' => 'admin'])->call('GET', url('thread/showSearchedThread/orderByCreatedTime', 1), ['keyword' => $keyword]);
        $response->assertStatus(200);
        $response->assertViewIs('component.threadComponent');
        $response->assertSeeTextInOrder(['thread3', 'thread2', 'thread1']);
    }

    public function testShowSearchedThreadOrderByNumberOfPosting(): void
    {
        $keyword = 'thread';
        $response = $this->withSession(['username' => 'admin'])->call('GET', url('thread/showSearchedThread/orderByNumberOfPosting', 1), ['keyword' => $keyword]);
        $response->assertStatus(200);
        $response->assertViewIs('component.threadComponent');
        $response->assertSeeTextInOrder(['thread1', 'thread3']);
    }

    public function testShowUnwritableThread(): void
    {
        $this->seed('PostingToLimitSeeder');
        $postingList = Posting::where('thread_id', 1)->get();
        logger($postingList);
        $response = $this->withSession(['username' => 'admin'])->get(url('thread/showUnwritableThread', 1));
        $response->assertStatus(200);
        $response->assertViewIs('component.threadComponent');
        $response->assertSeeText('thread5');
        $response->assertDontSeeText('thread1');
        $response->assertDontSeeText('thread2');
        $response->assertDontSeeText('thread3');
        $response = $this->withSession(['username' => 'admin'])->get(url('posting/showPosting', 5));
        $response->assertSeeText('これ以上投稿できません');
    }
}
