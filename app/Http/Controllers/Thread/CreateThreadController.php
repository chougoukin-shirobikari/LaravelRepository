<?php

namespace App\Http\Controllers\Thread;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Genre;
use App\Thread;
use App\Http\Requests\ThreadRequest;

class CreateThreadController extends Controller
{
    //ThreadForm画面を表示
    public function toThreadForm($genre_id)
    {
        $genre = Genre::find($genre_id);
        return view('threadForm', ['genre' => $genre]);
    }

    //スレッドを作成
    public function createThread($genre_id, ThreadRequest $request)
    {
        DB::transaction(function() use($genre_id, $request){
            $thread = new Thread;
            $thread->thread_title = $request->thread_title;
            $thread->created_time = date("Y-m-d (D) H:i");
            $thread->number_of_posting = 0;
            $thread->genre_id = $genre_id;
            $thread->username = $request->session()->get('username');
            $thread->thread_version = 1;
            $thread->save();
        });

        return redirect(url('thread/showThread', $genre_id));
    }
}
