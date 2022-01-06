<?php

namespace App\Http\Controllers\Posting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Thread;
use App\Posting;
use App\Reply;
use App\Image;
use App\Lib\DeleteImage;
use App\Lib\MakeKeywords;
use App\Consts\Consts;

class DeletePostingController extends Controller
{
    //Postingの削除->Postingを昇順に表示
    public function deletePosting($thread_id, $posting_id, Request $request)
    {
        DB::transaction(function() use($posting_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('posting_id', $posting_id);
            $replyList->delete();

            //関連テーブル(Posting)の削除
            $posting = Posting::find($posting_id);
            if($posting->has_image === 1){
                //関連テーブル(Image)の削除
                DeleteImage::deleteImageByPostingId($posting_id);
            }
            $posting->name = '削除済み';
            $posting->writing_time = '削除済み';
            $posting->message = 'この投稿は削除されました';
            $posting->number_of_reply = 0;
            $posting->has_image = 0;
            $posting->save();
        });

        $thread = Thread::find($thread_id);
        $postingList = Posting::where('thread_id', $thread_id)->paginate(Consts::POSTING_PER_PAGE, ['*'], 'page', $request->page);
        $postingList->withPath('/posting/showPostingByAjax/' . $thread_id);
        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => '',
            'deleted' => 'yes'
        ]);
    }

    //Postingを削除->Postingを新しい順に表示
    public function deletePostingThenOrderByCreatedTime($thread_id, $posting_id, Request $request)
    {
        DB::transaction(function() use($posting_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('posting_id', $posting_id);
            $replyList->delete();

            //関連テーブル(Posting)の削除
            $posting = Posting::find($posting_id);
            if($posting->has_image === 1){
                //関連テーブル(Image)の削除
                DeleteImage::deleteImageByPostingId($posting_id);
            }
            $posting->name = '削除済み';
            $posting->writing_time = '削除済み';
            $posting->message = 'この投稿は削除されました';
            $posting->number_of_reply = 0;
            $posting->has_image = 0;
            $posting->save();
        });

        $thread = Thread::find($thread_id);
        $postingList = Posting::where('thread_id', $thread_id)->orderBy('posting_id', 'desc')->paginate(Consts::POSTING_PER_PAGE, ['*'], 'page', $request->page);
        $postingList->withPath('/posting/showPosting/orderByCreatedTime/' . $thread_id);
        $sort = $request->sort;
        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => $sort,
            'deleted' => 'yes'
        ]);
    }

    //検索条件に一致したPostingの中から削除->検索条件に一致したPostingを昇順に表示
    public function deleteSearchedPosting($thread_id, $posting_id, Request $request)
    {
        DB::transaction(function() use($posting_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('posting_id', $posting_id);
            $replyList->delete();

            //関連テーブル(Posting)の削除
            $posting = Posting::find($posting_id);
            if($posting->has_image === 1){
                //関連テーブル(Image)の削除
                DeleteImage::deleteImageByPostingId($posting_id);
            }
            $posting->name = '削除済み';
            $posting->writing_time = '削除済み';
            $posting->message = 'この投稿は削除されました';
            $posting->number_of_reply = 0;
            $posting->has_image = 0;
            $posting->save();
        });

        $thread = Thread::find($thread_id);

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = Posting::where('thread_id', $thread_id);
        foreach($keywords as $message){
            $query->where('message', 'LIKE', '%'.$message.'%');
        }
        $postingList = $query->paginate(Consts::POSTING_PER_PAGE, ['*'], 'page', $request->page);
        $postingList->withPath('/posting/showSearchedPosting/' . $thread_id);

        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => '',
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'deleted' => 'yes'
        ]);
    }

    //検索条件に一致したPostingの中から削除->検索条件に一致したPostingを新しい順に表示
    public function deleteSearchedPostingThenOrderByCreatedTime($thread_id, $posting_id, Request $request)
    {
        DB::transaction(function() use($posting_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('posting_id', $posting_id);
            $replyList->delete();

            //関連テーブル(Posting)の削除
            $posting = Posting::find($posting_id);
            if($posting->has_image === 1){
                //関連テーブル(Image)の削除
                DeleteImage::deleteImageByPostingId($posting_id);
            }
            $posting->name = '削除済み';
            $posting->writing_time = '削除済み';
            $posting->message = 'この投稿は削除されました';
            $posting->number_of_reply = 0;
            $posting->has_image = 0;
            $posting->save();
        });

        $thread = Thread::find($thread_id);

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = Posting::where('thread_id', $thread_id);
        foreach($keywords as $message){
            $query->where('message', 'LIKE', '%'.$message.'%');
        }
        $postingList = $query->orderBy('thread_id', 'desc')->paginate(Consts::POSTING_PER_PAGE, ['*'], 'page', $request->page);
        $postingList->withPath('/posting/showSearchedPosting/orderByCreatedTime/' . $thread_id);

        $sort = $request->sort;
        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => $sort,
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'deleted' => 'yes'
        ]);
    }

    //画像を削除->Postingを昇順に表示
    public function deletePostingImage($posting_id, Request $request)
    {
        //画像を削除
        $image = Image::where('posting_id', $posting_id)->first();
        $image_name = $image->image_name;
        $image_path = public_path('images/'. $image_name);
        $posting = Posting::find($posting_id);
        if(file_exists($image_path)){
            unlink($image_path);
            $image->delete();
            $posting->has_image = 0;
            $posting->save();
        }

        $thread_id = $posting->thread_id;
        $thread = Thread::find($thread_id);
        $postingList = Posting::where('thread_id', $thread_id)->paginate(Consts::POSTING_PER_PAGE, ['*'], 'page', $request->page);
        $postingList->withPath('/posting/showPostingByAjax/' . $thread_id);
        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => '',
            'deleted' => 'yes'
        ]);
    }

    //画像を削除->Postingを新しい順に表示
    public function deletePostingImageThrenOrderByCreatedTime($posting_id, Request $request)
    {
        //画像を削除
        $image = Image::where('posting_id', $posting_id)->first();
        $image_name = $image->image_name;
        $image_path = public_path('images/'. $image_name);
        $posting = Posting::find($posting_id);
        if(file_exists($image_path)){
            unlink($image_path);
            $image->delete();
            $posting->has_image = 0;
            $posting->save();
        }

        $thread_id = $posting->thread_id;
        $thread = Thread::find($thread_id);
        $postingList = Posting::where('thread_id', $thread_id)->orderBy('posting_id', 'desc')->paginate(Consts::POSTING_PER_PAGE, ['*'], 'page', $request->page);
        $postingList->withPath('/posting/showPosting/orderByCreatedTime/' . $thread_id);
        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => 'orderByCreatedTime',
            'deleted' => 'yes'
        ]);
    }

    //検索条件に一致したPostingの画像を削除->検索条件に一致したPostingを昇順に表示
    public function deleteSearchedPostingImage($posting_id, Request $request)
    {
        //画像を削除
        $image = Image::where('posting_id', $posting_id)->first();
        $image_name = $image->image_name;
        $image_path = public_path('images/'. $image_name);
        $posting = Posting::find($posting_id);
        if(file_exists($image_path)){
            unlink($image_path);
            $image->delete();
            $posting->has_image = 0;
            $posting->save();
        }
        $thread_id = $posting->thread_id;
        $thread = Thread::find($thread_id);

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = Posting::where('thread_id', $thread_id);
        foreach($keywords as $message){
            $query->where('message', 'LIKE', '%'.$message.'%');
        }
        $postingList = $query->paginate(Consts::POSTING_PER_PAGE, ['*'], 'page', $request->page);
        $postingList->withPath('/posting/showSearchedPosting/' . $thread_id);
        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => '',
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'deleted' => 'yes'

        ]);
    }

    //検索条件に一致したPostingの画像を削除->検索条件に一致したPostingを新しい順に表示
    public function deleteSearchedPostingImageThrenOrderByCreatedTime($posting_id, Request $request)
    {
        //画像を削除
        $image = Image::where('posting_id', $posting_id)->first();
        $image_name = $image->image_name;
        $image_path = public_path('images/'. $image_name);
        $posting = Posting::find($posting_id);
        if(file_exists($image_path)){
            unlink($image_path);
            $image->delete();
            $posting->has_image = 0;
            $posting->save();
        }
        $thread_id = $posting->thread_id;
        $thread = Thread::find($thread_id);

        //入力されたキーワードからクエリを作成
        $keyword = $request->keyword;
        $keywords = MakeKeywords::makeKeywords($keyword);
        $query = Posting::where('thread_id', $thread_id);
        foreach($keywords as $message){
            $query->where('message', 'LIKE', '%'.$message.'%');
        }
        $postingList = $query->orderBy('posting_id', 'desc')->paginate(Consts::POSTING_PER_PAGE, ['*'], 'page', $request->page);
        $postingList->withPath('/posting/showSearchedPosting/orderByCreatedTime/' . $thread_id);

        return view('component.postingComponent', [
            'thread' => $thread,
            'postingList' => $postingList,
            'sort' => 'orderByCreatedTime',
            'keyword' => $keyword,
            'haskeyword' => 'yes',
            'searchedwords' => json_encode($keywords),
            'deleted' => 'yes'

        ]);
    }

}
