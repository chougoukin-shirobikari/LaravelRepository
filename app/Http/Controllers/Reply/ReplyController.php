<?php

namespace App\Http\Controllers\Reply;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Posting;
use App\Reply;
use App\Http\Requests\ReplyRequest;
use App\Consts\Consts;

class ReplyController extends Controller
{
    //コメント(Reply)を表示
    public function showReply($posting_id)
    {
        $posting = Posting::find($posting_id);
        $replyList = Reply::where('posting_id', $posting_id)->get();
        return view('reply', [
            'posting' => $posting,
            'replyList' => $replyList
        ]);
    }

    //ReplyForm画面を表示
    public function toReplyForm($posting_id)
    {
        $posting = Posting::find($posting_id);
        //投稿件数制限を超えていないかチェック->超えていた場合はリダイレクト
        if($posting->number_of_reply >= Consts::MAX_NUMBER_OF_REPLY){
            return redirect(url('reply/showReply', $posting_id));
        }
        return view('replyForm', ['posting' => $posting]);
    }

    //コメント(Reply)を作成
    public function createReply($posting_id, ReplyRequest $request)
    {
        DB::transaction(function() use($posting_id, $request){
            $posting = Posting::find($posting_id);
            $thread_id = $posting->thread_id;
            $genre_id = $posting->genre_id;

            $reply = new Reply;
            $reply->reply_no = $posting->number_of_reply + 1;
            $reply->name = $request->name;
            $reply->reply_message = $request->reply_message;
            $reply->reply_time = date("Y-m-d (D) H:i");
            $reply->posting_id = $posting_id;
            $reply->thread_id = $thread_id;
            $reply->genre_id = $genre_id;
            $reply->username = $request->session()->get('username');
            $reply->save();

            $posting->number_of_reply++;
            $posting->posting_version = $request->posting_version;
            $posting->save();
        });

        return redirect(url('reply/showReply', $posting_id));
    }

    //コメント(Reply)を削除
    public function deleteReply($posting_id, $reply_id)
    {
        DB::transaction(function() use($reply_id){
            $reply = Reply::find($reply_id);
            $reply->name = '削除済み';
            $reply->reply_time = '削除済み';
            $reply->reply_message = 'この返信は削除されました';
            $reply->save();
        });

        $posting = Posting::find($posting_id);
        $replyList = Reply::where('posting_id', $posting_id)->get();
        return view('component.replyComponent', [
            'posting' => $posting,
            'replyList' => $replyList
        ]);
    }
}
