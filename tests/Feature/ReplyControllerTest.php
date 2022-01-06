<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Reply;

class ReplyControllerTest extends TestCase
{
    use RefreshDataBase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');

    }

    public function testOptimisticLockException()
    {
        $request = [
            'name' => 'name',
            'reply_message' => 'OptimisticLockException',
            'posting_version' => 0
        ];

        $response = $this->withSession(['username' => 'admin'])->post(url('reply/createReply', 1), $request);
        $response->assertStatus(302);

        $response = $this->get(url('reply/toReplyForm', 1));
        $response->assertSeeText('※エラーが発生したためコメントできませんでした');
        $reply = [
            'name' => 'name',
            'reply_message' => 'OptimisticLockException'
        ];
        $this->assertDatabaseMissing('reply', $reply);


        /*
        $this->expectException(Exception::class);
        (new ExampleService)->execute(1);
        */
    }
}
