<?php

namespace App\Http\Controllers\Posting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Thread;
use App\Posting;
use App\Image;
use App\Http\Requests\PostingRequest;
use App\Consts\Consts;

class CreatePostingController extends Controller
{
    //PostingForm画面を表示
    public function toPostingForm($thread_id)
    {
        $thread = Thread::find($thread_id);
        //投稿件数制限を超えていないかチェック->超えていた場合はリダイレクト
        if($thread->number_of_posting >= Consts::MAX_NUMBER_OF_POSTING){
            return redirect(url('posting/showPosting', $thread_id));
        }
        return view('postingForm', ['thread' => $thread]);
    }

    //投稿(Posting)を作成
    public function createPosting($thread_id, PostingRequest $request)
    {
        DB::transaction(function() use($thread_id, $request){
            $thread = Thread::find($thread_id);
            $genre_id = $thread->genre_id;

            $posting = new Posting;
            $posting->posting_no = $thread->number_of_posting + 1;
            $posting->name = $request->name;
            $posting->message = $request->message;
            $posting->writing_time = date("Y-m-d (D) H:i");
            $posting->number_of_reply = 0;
            $posting->genre_id = $genre_id;
            $posting->thread_id = $thread_id;
            $posting->username = $request->session()->get('username');
            $posting->posting_version = 1;

            //リクエストに画像が含まれていた場合はアップロード
            $file = $request->file('image');
            if(!empty($file)){
                $posting->has_image = 1;
                $posting->save();

                $filename = time() . $file->getClientOriginalName();
                $image_path = public_path('images/');
                $file->move($image_path, $filename);
                $image = new Image;
                $image->image_name = $filename;
                $image->created_time = date("Y-m-d (D) H:i");
                $image->posting_id = $posting->posting_id;
                $image->thread_id = $thread_id;
                $image->genre_id = $genre_id;
                $image->save();
            }else{
                $posting->has_image = 0;
                $posting->save();
            }

            $thread->number_of_posting++;
            $thread->thread_version = $request->thread_version;
            $thread->save();
        });

        return redirect(url('posting/showPosting', $thread_id));
    }
}
