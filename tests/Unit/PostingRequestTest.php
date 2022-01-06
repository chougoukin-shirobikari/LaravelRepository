<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\PostingRequest;
use Validator;

class PostingRequestTest extends TestCase
{
    use RefreshDataBase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');

    }

    public function testFileIsInvalid(): void
    {
        $file = UploadedFile::fake()->create(name:'test.txt', mimeType:'text/plain');

        $requestParam = [
            'name' => 'name',
            'message' => 'message',
            'image' => $file
        ];

        $request = new PostingRequest;
        $rules = $request->rules();
        $messages = $request->messages();
        $validator = Validator::make($requestParam, $rules, $messages);
        $actualMessage = $validator->messages()->get('image');
        $expectedMessage = '※エラーが発生したため画像を投稿できませんでした';

        $this->assertSame($expectedMessage, $actualMessage[array_search($expectedMessage, $actualMessage, true)]);
    }
}
