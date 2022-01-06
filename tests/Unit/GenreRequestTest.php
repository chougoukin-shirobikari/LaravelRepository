<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\GenreRequest;
use Validator;

class GenreRequestTest extends TestCase
{
    use RefreshDataBase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');

    }
    public function testGenreTitleIsBlank(): void
    {
        $requestParam = [
            'genre_title' => ''
        ];

        $request = new GenreRequest;
        $rules = $request->rules();
        $messages = $request->messages();
        $validator = Validator::make($requestParam, $rules, $messages);
        $actualMessage = $validator->messages()->get('genre_title');
        $expectedMessage = 'ジャンル名を入力してください';

        $this->assertSame($expectedMessage, $actualMessage[array_search($expectedMessage, $actualMessage, true)]);
    }

    public function testGenreTitleIsDoubleSpace(): void
    {
        $requestParam = [
            'genre_title' => '　'
        ];

        $request = new GenreRequest;
        $rules = $request->rules();
        $messages = $request->messages();
        $validator = Validator::make($requestParam, $rules, $messages);
        $actualMessage = $validator->messages()->get('genre_title');
        $expectedMessage = 'エラー:入力がすべて全角スペースです';

        $this->assertSame($expectedMessage, $actualMessage[array_search($expectedMessage, $actualMessage, true)]);
    }

    public function testGenreTitleContainsNgword(): void
    {
        $requestParam = [
            'genre_title' => 'ngword'
        ];

        $request = new GenreRequest;
        $rules = $request->rules();
        $messages = $request->messages();
        $validator = Validator::make($requestParam, $rules, $messages);
        $actualMessage = $validator->messages()->get('genre_title');
        $expectedMessage = 'NGワードが含まれています';

        $this->assertSame($expectedMessage, $actualMessage[array_search($expectedMessage, $actualMessage, true)]);
    }

    public function testOverCharacterLimit(): void
    {
        $requestParam = [
            'genre_title' => '８文字以内で入力してください'
        ];

        $request = new GenreRequest;
        $rules = $request->rules();
        $messages = $request->messages();
        $validator = Validator::make($requestParam, $rules, $messages);
        $actualMessage = $validator->messages()->get('genre_title');
        $expectedMessage = '８文字以内で入力してください';

        $this->assertSame($expectedMessage, $actualMessage[array_search($expectedMessage, $actualMessage, true)]);
    }

    public function testGenreTitleIsUniqur(): void
    {
        $requestParam = [
            'genre_title' => 'genre1'
        ];

        $request = new GenreRequest;
        $rules = $request->rules();
        $messages = $request->messages();
        $validator = Validator::make($requestParam, $rules, $messages);
        $actualMessage = $validator->messages()->get('genre_title');
        $expectedMessage = 'エラー: ジャンルタイトルの重複';

        $this->assertSame($expectedMessage, $actualMessage[array_search($expectedMessage, $actualMessage, true)]);
    }
}
