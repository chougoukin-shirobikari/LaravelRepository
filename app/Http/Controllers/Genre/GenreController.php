<?php

namespace App\Http\Controllers\Genre;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Genre;
use App\Thread;
use App\Posting;
use App\Reply;
use App\Http\Requests\GenreRequest;
use App\Lib\DeleteImage;

class GenreController extends Controller
{
    //ジャンルを表示
    public function showGenre()
    {
        $genreList = Genre::all();
        return view('genre', ['genreList' => $genreList]);
    }

    //GenreForm画面を表示
    public function toGenreForm()
    {
        return view('genreForm');
    }

    //ジャンルを作成
    public function createGenre(GenreRequest $request)
    {

        DB::transaction(function() use($request){
            $genre = new Genre;
            $genre->genre_title = $request->genre_title;
            $genre->save();
        });

        return redirect('genre/showGenre');
    }

    //ジャンルを削除
    public function deleteGenre($genre_id)
    {
        DB::transaction(function() use($genre_id){
            //関連テーブル(Reply)の削除
            $replyList = Reply::where('genre_id', $genre_id);
            $replyList->delete();

            //関連テーブル(Image)の削除
            DeleteImage::deleteImageByGenreId($genre_id);

            //関連テーブル(Posting)の削除
            $postingList = Posting::where('genre_id', $genre_id);
            $postingList->delete();

            //関連テーブル(Thread)の削除
            $threadList = Thread::where('genre_id', $genre_id);
            $threadList->delete();

            $genre = Genre::find($genre_id);
            $genre->delete();
        });

        $genreList = Genre::all();
        return view('component.genreComponent', ['genreList' => $genreList]);
    }

}
