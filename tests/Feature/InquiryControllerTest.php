<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Mockery;
use App\Lib\SendMail;

class InquiryControllerTest extends TestCase
{
    use RefreshDataBase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');

    }

    public function testMakeAnInquiry(): void
    {
        Mail::fake();
        /*
        $message = 'inquiry';
        $this->mock(SendMail::class, function ($mock) use($message) {
            $mock->shouldReceive('sendMail')->once()->with($message)->andReturnNull();
        });
        */

        $inquiry = [
            'username' => 'admin',
            'message' => 'inquiry'
        ];

        $response = $this->withSession(['username' => 'admin'])->post(url('makeAnInquiry'), $inquiry);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect('toInquiryForm');

        $response = $this->get(url('toInquiryForm'));
        $response->assertSeeText('送信が完了しました');
        $this->assertDatabaseHas('inquiry', $inquiry);

    }
}
