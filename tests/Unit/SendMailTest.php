<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
//use Mail;

class SendMailTest extends TestCase
{
    public function testSendMail(): void
    {
        Mail::fake();
        Mail::assertNothingSent();
        $name = 'user';
        Mail::to('banana0822hairuyo@gmail.com')->send(new SendMail($name));
        Mail::assertSent(sendMail::class, 1);
        /*
        Mail::assertSent(sendMail::class, function ($mail) {
            return $mail->hasFrom('banana0822hairuyo@gmail.com') && $mail->hasTo('banana0822hairuyo@gmail.com');
        });
        */

    }
}
