<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Genre;
use App\Thread;
use App\Posting;
use Validator;

class SearchController extends Controller
{
    //検索関連画面のタブを表示
    public function toSearch()
    {
        $ngwordList = array();
        $userInfoList = array();
        $inquiryList = array();

        return view('search', [
            'collapse' => '',
            'ngword' => '',
            'userInfo' => '',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList
        ]);
    }

    //検索条件に一致したPostingを表示する
    public function searchPosting(Request $request)
    {
        $rules = [
            'genre_title' => 'required',
            'thread_title' => 'required',
            'posting_no' => 'integer'
        ];

        $messages = [
            'genre_title.required' => '未入力',
            'thread_title.required' => '未入力',
            'posting_no.integer' => '半角の数字を入力してください'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect(url('toManagement'))->with(['collapse' => 1])->withErrors($validator)->withInput();
        }

        $genre_id = Genre::where('genre_title', $request->genre_title)->value('genre_id');
        $thread_id = Thread::where('genre_id', $genre_id)->where('thread_title', $request->thread_title)->value('thread_id');
        $posting = Posting::where('thread_id', $thread_id)->where('thread_id', $thread_id)->where('posting_no', $request->posting_no)->get();

        //検索条件に一致するPostingが見つからなかったときはリダイレクト
        if(count($posting) === 0){
            return redirect(url('toManagement'))->with(['postingNotFound' => 'yes', 'collapse' => 1]);
        }

        return redirect(url('posting/showPosting', $posting->posting_id))->with('posging_no_bySeach', $request->posting_no);

    }

    //検索条件に一致したReplyを表示する
    public function searchReply(Request $request)
    {
        $rules = [
            'genre_title' => 'required',
            'thread_title' => 'required',
            'posting_no' => 'integer',
            'reply_no' => 'integer'
        ];

        $messages = [
            'genre_title.required' => '未入力',
            'thread_title.required' => '未入力',
            'posting_no.integer' => '半角の数字を入力してください',
            'reply_no.integer' => '半角の数字を入力してください'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect(url('toManagement'))->with(['collapse' => 2])->withErrors($validator)->withInput();
        }

        $genre_id = Genre::where('genre_title', $request->genre_title)->value('genre_id');
        $thread_id = Thread::where('genre_id', $genre_id)->where('thread_title', $request->thread_title)->value('thread_id');
        $posting = Posting::where('thread_id', $thread_id)->where('thread_id', $thread_id)->where('posting_no', $request->posting_no)->get();

        //検索条件に一致するReplyが見つからなかったときはリダイレクト
        if(count($posting) === 0){
            return redirect(url('toManagement'))->with(['replyNotFound' => 'yes', 'collapse' => 2]);
        }

        return redirect(url('reply/showReply', $posting->posting_id))->with('reply_no_bySeach', $request->reply_no);
    }


}
