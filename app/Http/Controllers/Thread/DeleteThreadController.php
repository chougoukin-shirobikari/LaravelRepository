<?php

namespace App\Http\Controllers\Thread;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Genre;
use App\Thread;
use App\Posting;
use App\Reply;
use App\Lib\DeleteImage;
use App\Lib\MakeKeywords;
use App\Consts\Consts;

class DeleteThreadController extends Controller
{
    //スレッドの削除->スレッドを昇順に表示
    public function deleteThread($genre_id, $thread_id, Request $request)
    {
        DB::transaction(function() use($thread_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('thread_id', $thread_id);
            $replyList->delete();

            //関連テーブル(Image)の削除
            DeleteImage::deleteImageByThreadId($thread_id);

            //関連テーブル(Posting)の削除
            $postingList = Posting::where('thread_id', $thread_id);
            $postingList->delete();

            $thread = Thread::find($thread_id);
            $thread->delete();
        });

        $genre = Genre::find($genre_id);

        //スレッドを削除後、ページ内に表示するスレッドがなくなる場合、1つ前のページを表示する
        $total = $request->total;
        if($total != 0 && ($total - 1) % 3 === 0) {
            $threadList = Thread::where('genre_id', $genre_id)->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page - 1);
		}else{
            $threadList = Thread::where('genre_id', $genre_id)->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page);
        }
        $threadList->withPath('thread/showThreadByAjax/' . $genre_id);

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => '',
            'deleted' => 'yes'
        ]);
    }

    //スレッドを削除->スレッドを新しい順に表示
    public function deleteThreadThenOrderByCreatedTime($genre_id, $thread_id, Request $request)
    {
        DB::transaction(function() use($thread_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('thread_id', $thread_id);
            $replyList->delete();

            //関連テーブル(Image)の削除
            DeleteImage::deleteImageByThreadId($thread_id);

            //関連テーブル(Posting)の削除
            $postingList = Posting::where('thread_id', $thread_id);
            $postingList->delete();

            $thread = Thread::find($thread_id);
            $thread->delete();
        });

        $genre = Genre::find($genre_id);

        //スレッドを削除後、ページ内に表示するスレッドがなくなる場合、1つ前のページを表示する
        $total = $request->total;
        if($total != 0 && ($total - 1) % 3 === 0) {
            $threadList = Thread::where('genre_id', $genre_id)->orderBy('thread_id', 'desc')->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page - 1);
		}else{
            $threadList = Thread::where('genre_id', $genre_id)->orderBy('thread_id', 'desc')->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page);
        }
        $threadList->withPath('thread/showThread/orderByCreatedTime/' . $genre_id);

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => $request->sort,
            'deleted' => 'yes'
        ]);

    }

    //スレッドを削除->スレッドを投稿件数が多い順に表示
    public function deleteThreadThenOrderByNumberOfPosting($genre_id, $thread_id, Request $request)
    {
        DB::transaction(function() use($thread_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('thread_id', $thread_id);
            $replyList->delete();

            //関連テーブル(Image)の削除
            DeleteImage::deleteImageByThreadId($thread_id);

            //関連テーブル(Posting)の削除
            $postingList = Posting::where('thread_id', $thread_id);
            $postingList->delete();

            $thread = Thread::find($thread_id);
            $thread->delete();
        });

        $genre = Genre::find($genre_id);

        //スレッドを削除後、ページ内に表示するスレッドがなくなる場合、1つ前のページを表示する
        $total = $request->total;
        if($total != 0 && ($total - 1) % 3 === 0) {
            $threadList = Thread::where('genre_id', $genre_id)->orderBy('number_of_posting', 'desc')->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page - 1);
		}else{
            $threadList = Thread::where('genre_id', $genre_id)->orderBy('number_of_posting', 'desc')->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page);
        }
        $threadList->withPath('thread/showThread/orderByNumberOfPosting/' . $genre_id);

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => $request->sort,
            'deleted' => 'yes'
        ]);

    }

    //検索条件に一致したThreadの中から削除->検索条件に一致したスレッドを昇順に表示
    public function deleteSearchedThread($genre_id, $thread_id, Request $request)
    {
        DB::transaction(function() use($thread_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('thread_id', $thread_id);
            $replyList->delete();

            //関連テーブル(Image)の削除
            DeleteImage::deleteImageByThreadId($thread_id);

            //関連テーブル(Posting)の削除
            $postingList = Posting::where('thread_id', $thread_id);
            $postingList->delete();

            $thread = Thread::find($thread_id);
            $thread->delete();
        });

        $genre = Genre::find($genre_id);

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = Thread::where('genre_id', $genre_id);
        foreach($keywords as $thread_title){
            $query->where('thread_title', 'LIKE', '%'.$thread_title.'%');
        }

        //スレッドを削除後、ページ内に表示するスレッドがなくなる場合、1つ前のページを表示する
        $total = $request->total;
        if($total != 0 && ($total - 1) % 3 === 0) {
            $threadList = $query->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page - 1);
		}else{
            $threadList = $query->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page);
        }
        $threadList->withPath('/thread/showSearchedThread/' . $genre_id);

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => '',
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'deleted' => 'yes'

        ]);

    }

    //検索条件に一致したThreadの中から削除->検索条件に一致したスレッドを新しい順に表示
    public function deleteSearchedThreadThenOrderByCreatedTime($genre_id, $thread_id, Request $request)
    {
        DB::transaction(function() use($thread_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('thread_id', $thread_id);
            $replyList->delete();

            //関連テーブル(Image)の削除
            DeleteImage::deleteImageByThreadId($thread_id);

            //関連テーブル(Posting)の削除
            $postingList = Posting::where('thread_id', $thread_id);
            $postingList->delete();

            $thread = Thread::find($thread_id);
            $thread->delete();
        });

        $genre = Genre::find($genre_id);

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = Thread::where('genre_id', $genre_id);
        foreach($keywords as $thread_title){
            $query->where('thread_title', 'LIKE', '%'.$thread_title.'%');
        }

        //スレッドを削除後、ページ内に表示するスレッドがなくなる場合、1つ前のページを表示する
        $total = $request->total;
        if($total != 0 && ($total - 1) % 3 === 0) {
            $threadList = $query->orderBy('thread_id', 'desc')->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page - 1);
		}else{
            $threadList = $query->orderBy('thread_id', 'desc')->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page);
        }
        $threadList->withPath('/thread/showSearchedThread/orderByCreatedTime/' . $genre_id);

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => $request->sort,
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'deleted' => 'yes'
        ]);

    }

    //検索条件に一致したThreadの中から削除->検索条件に一致したスレッドを投稿件数が多い順に表示
    public function deleteSearchedThreadThenOrderByNumberOfPosting($genre_id, $thread_id, Request $request)
    {
        DB::transaction(function() use($thread_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('thread_id', $thread_id);
            $replyList->delete();

            //関連テーブル(Image)の削除
            DeleteImage::deleteImageByThreadId($thread_id);

            //関連テーブル(Posting)の削除
            $postingList = Posting::where('thread_id', $thread_id);
            $postingList->delete();

            $thread = Thread::find($thread_id);
            $thread->delete();
        });

        $genre = Genre::find($genre_id);

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = Thread::where('genre_id', $genre_id);
        foreach($keywords as $thread_title){
            $query->where('thread_title', 'LIKE', '%'.$thread_title.'%');
        }

        //スレッドを削除後、ページ内に表示するスレッドがなくなる場合、1つ前のページを表示する
        $total = $request->total;
        if($total != 0 && ($total - 1) % 3 === 0) {
            $threadList = $query->orderBy('number_of_posting', 'desc')->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page - 1);
		}else{
            $threadList = $query->orderBy('number_of_posting', 'desc')->paginate(Consts::THREAD_PER_PAGE, ['*'], 'page', $request->page);
        }
        $threadList->withPath('/thread/showSearchedThread/orderByNumberOfPosting/' . $genre_id);

        return view('component.threadComponent', [
            'genre' => $genre,
            'threadList' => $threadList,
            'sort' => $request->sort,
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'deleted' => 'yes'
        ]);

    }
}
