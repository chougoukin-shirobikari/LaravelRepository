<?php

namespace App\Http\Controllers\Posting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Thread;
use App\Posting;
use App\Lib\MakeKeywords;
use App\Consts\Consts;
use App\Rules\DoubleSpace;
use Validator;


class ShowPostingController extends Controller
{
    //投稿(Posting)を表示
    public function orderByAsc($thread_id)
    {
        $thread = Thread::find($thread_id);
        $postingList = Posting::where('thread_id', $thread_id)->paginate(Consts::POSTING_PER_PAGE);
        $postingList->withPath('/posting/showPostingByAjax/' . $thread_id);
        return view('posting', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => ''
        ]);
    }

    //投稿(Posting)をAjaxで表示
    public function orderByAscByAjax($thread_id)
    {
        $thread = Thread::find($thread_id);
        $postingList = Posting::where('thread_id', $thread_id)->paginate(Consts::POSTING_PER_PAGE);
        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => ''
        ]);
    }

    //投稿(Posting)を新しい順に表示
    public function orderByCreatedTime($thread_id, Request $request)
    {
        $thread = Thread::find($thread_id);
        $postingList = Posting::where('thread_id', $thread_id)->orderBy('posting_id', 'desc')->paginate(Consts::POSTING_PER_PAGE);
        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => 'orderByCreatedTime'
        ]);
    }

    //検索条件に一致した投稿(Posting)を昇順で表示
    public function showSearchedPosting_orderByAsc($thread_id, Request $request)
    {

        $thread = Thread::find($thread_id);

        $rules = [
            'keyword' => ['required', new DoubleSpace]
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $postingList = Posting::where('thread_id', $thread_id)->paginate(Consts::POSTING_PER_PAGE);
            $postingList->withPath('/posting/showPostingByAjax/' . $thread_id);
            return view('component.postingComponent', [
                'thread' => $thread,
                'postingList' => $postingList,
                'sort' => '',
                'isBlank' => 'yes'
            ]);
        }

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = DB::table('posting')->where('thread_id', $thread_id);
        foreach($keywords as $message){
            $query->where('message', 'LIKE', '%'.$message.'%');
        }
        $postingList = $query->paginate(Consts::POSTING_PER_PAGE);

        if($postingList->total() === 0){
            $notFound = 'yes';
        }else{
            $notFound = 'no';
        }

        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => '',
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'notFound' => $notFound
        ]);
    }

    //検索条件に一致した投稿(Posting)を新しい順に表示
    public function showSearchedPosting_orderByCreatedTime($thread_id, Request $request)
    {
        $thread = Thread::find($thread_id);

        $rules = [
            'keyword' => ['required', new DoubleSpace]
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $postingList = Posting::where('thread_id', $thread_id)->paginate(Consts::POSTING_PER_PAGE);
            $postingList->withPath('/posting/showPostingByAjax/' . $thread_id);
            return view('component.postingComponent', [
                'thread' => $thread,
                'postingList' => $postingList,
                'sort' => '',
                'isBlank' => 'yes'
            ]);
        }

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = DB::table('posting')->where('thread_id', $thread_id);
        foreach($keywords as $message){
            $query->where('message', 'LIKE', '%'.$message.'%');
        }
        $postingList = $query->orderBy('posting_id', 'desc')->paginate(Consts::POSTING_PER_PAGE);

        if($postingList->total() === 0){
            $notFound = 'yes';
        }else{
            $notFound = 'no';
        }

        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => 'orderByCreatedTime',
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'notFound' => $notFound
        ]);
    }

}
