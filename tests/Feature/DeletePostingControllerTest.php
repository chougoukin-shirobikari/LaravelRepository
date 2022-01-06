<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Tests\TestCase;
use App\Posting;
use App\Image;

class DeletePostingControllerTest extends TestCase
{
    use RefreshDataBase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');

    }

    public function testDeletePostingImage(): void
    {
        $file = UploadedFile::fake()->image('test.jpg');
        $request = [
            'name' => 'name',
            'message' => 'upload',
            'image' => $file
        ];

        $response = $this->withSession(['username' => 'admin'])->post(url('posting/createPosting', 1), $request);
        $response->assertStatus(302);

        $posting = Posting::where('message', 'upload')->first();
        $image = Image::where('posting_id', $posting->posting_id)->first();
        $filepath = public_path('images/') . $image->image_name;
        $fileExists = File::exists($filepath);
        $this->assertTrue($fileExists);

        $response = $this->withSession(['username' => 'admin'])->delete(url('posting/deletePostingImage', $posting->posting_id));
        $response->assertStatus(200);
        $fileExists = File::exists($filepath);
        $this->assertTrue(!$fileExists);

    }
}
