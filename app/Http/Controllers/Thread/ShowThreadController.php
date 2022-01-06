<?php

namespace App\Http\Controllers\Thread;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Genre;
use App\Thread;
use App\Lib\MakeKeywords;
use App\Consts\Consts;
use App\Rules\DoubleSpace;
use Validator;

class ShowThreadController extends Controller
{
    //スレッドを昇順で表示
    public function orderByAsc($genre_id)
    {
        $genre = Genre::find($genre_id);
        $threadList = Thread::where('genre_id', $genre_id)->paginate(Consts::THREAD_PER_PAGE);
        $threadList->withPath('/thread/showThreadByAjax/' . $genre_id);

        return view('thread', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => ''
        ]);
    }

    //スレッドをAjaxで表示
    public function orderByAscByAjax($genre_id)
    {
        $genre = Genre::find($genre_id);
        $threadList = Thread::where('genre_id', $genre_id)->paginate(Consts::THREAD_PER_PAGE);

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => ''
        ]);
    }

    //スレッドを新しい順に表示
    public function orderByCreatedTime($genre_id, Request $request)
    {
        $genre = Genre::find($genre_id);
        $threadList = Thread::where('genre_id', $genre_id)->orderBy('thread_id', 'desc')->paginate(Consts::THREAD_PER_PAGE);

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => $request->sort
        ]);
    }

    //スレッドを投稿件数が多い順に表示
    public function orderByNumberOfPosting($genre_id, Request $request)
    {
        $genre = Genre::find($genre_id);
        $threadList = Thread::where('genre_id', $genre_id)->orderBy('number_of_posting', 'desc')->paginate(Consts::THREAD_PER_PAGE);

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => $request->sort
        ]);
    }

    //検索条件に一致したスレッドを昇順で表示
    public function showSearchedThread_orderByAsc($genre_id, Request $request)
    {
        $genre = Genre::find($genre_id);

        $rules = [
            'keyword' => ['required', new DoubleSpace]
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $threadList = Thread::where('genre_id', $genre_id)->paginate(Consts::THREAD_PER_PAGE);
            $threadList->withPath('/thread/showThreadByAjax/' . $genre_id);

            return view('component.threadComponent', [
                'genre' => $genre,
                'threadList' => $threadList,
                'sort' => '',
                'isBlank' => 'yes'
            ]);
        }

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = Thread::where('genre_id', $genre_id);
        foreach($keywords as $thread_title){
            $query->where('thread_title', 'LIKE', '%'.$thread_title.'%');
        }
        $threadList = $query->paginate(Consts::THREAD_PER_PAGE);

        if($threadList->total() === 0){
            $notFound = 'yes';
        }else{
            $notFound = 'no';
        }

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => '',
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'notFound' => $notFound
        ]);
    }

    //検索条件に一致したスレッドを新しい順に表示
    public function showSearchedThread_orderByCreatedTime($genre_id, Request $request)
    {
        $genre = Genre::find($genre_id);

        $rules = [
            'keyword' => ['required', new DoubleSpace]
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $threadList = Thread::where('genre_id', $genre_id)->paginate(Consts::THREAD_PER_PAGE);
            $threadList->withPath('/thread/showThreadByAjax/' . $genre_id);

            return view('component.threadComponent', [
                'genre' => $genre,
                'threadList' => $threadList,
                'sort' => '',
                'isBlank' => 'yes'
            ]);
        }

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = DB::table('thread')->where('genre_id', $genre_id);
        foreach($keywords as $thread_title){
            $query->where('thread_title', 'LIKE', '%'.$thread_title.'%');
        }
        $threadList = $query->orderBy('thread_id', 'desc')->paginate(Consts::THREAD_PER_PAGE);
        if($threadList->total() === 0){
            $notFound = 'yes';
        }else{
            $notFound = 'no';
        }

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => $request->keyword,
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'notFound' => $notFound
        ]);
    }

    //検索条件に一致したスレッドを投稿件数が多い順に表示
    public function showSearchedThread_orderByNumberOfPosting($genre_id, Request $request)
    {
        $genre = Genre::find($genre_id);

        $rules = [
            'keyword' => ['required', new DoubleSpace]
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $threadList = Thread::where('genre_id', $genre_id)->paginate(Consts::THREAD_PER_PAGE);
            $threadList->withPath('/thread/showThreadByAjax/' . $genre_id);

            return view('component.threadComponent', [
                'genre' => $genre,
                'threadList' => $threadList,
                'sort' => '',
                'isBlank' => 'yes'
            ]);
        }

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = DB::table('thread')->where('genre_id', $genre_id);
        foreach($keywords as $thread_title){
            $query->where('thread_title', 'LIKE', '%'.$thread_title.'%');
        }
        $threadList = $query->orderBy('number_of_posting', 'desc')->paginate(Consts::THREAD_PER_PAGE);
        if($threadList->total() === 0){
            $notFound = 'yes';
        }else{
            $notFound = 'no';
        }

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => $request->sort,
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'notFound' => $notFound
        ]);
    }

    //投稿可能件数を超えたスレッドをまとめて表示
    public function showUnwritableThread($genre_id)
    {
        $genre = Genre::find($genre_id);
        $threadList = Thread::where('number_of_posting', Consts::MAX_NUMBER_OF_POSTING)->paginate(Consts::THREAD_PER_PAGE);
        if($threadList->total() === 0){
            $notFound = 'yes';
        }else{
            $notFound = 'no';
        }

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => '',
            'notFound' => $notFound
        ]);
    }
}
