<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset('/css/app.css')}}" rel="stylesheet">
<title>BBS</title>
</head>
<body>
    <div class="container">
        <div id="content">
            <div class="row vh-100 mt-5 mt-md-0 align-items-md-center justify-content-md-center">
                <div class="jumbotron bg-white" style="max-width: 600px;">
                    <h2 class="mb-4 display-2 text-center text-nowrap">Various Genres</h1>
                    <p class="lead text-center">ジャンル一覧</p>
                    <div class="row mb-4">
                        @foreach($genreList as $genre)
                        <div class="col-6 col-md-4">
                            <div class="mb-3">
                                <a href="{{url('thread/showThread', $genre->genre_id)}}">
                                    <span class="w-100 btn btn-primary rounded-pill text-white">{{$genre->genre_title}}</span>
                                </a>
                                @if(Session::get('role') === 'ADMIN')
                                <div class="text-center">
                                    <button class="btn btn-link"  type="button" id="modalButton"
                                            data-title="{{$genre->genre_title}}"
                                            data-genreid={{$genre->genre_id}}
                                            data-bs-toggle="modal"
                                            data-bs-target="#fadeModal">※削除する</button>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- ADMIN権限を持つユーザーのみ表示 -->
                    @if(Session::get('role') === 'ADMIN')
                    <div class="text-center">
                        <a class="btn btn-outline-primary rounded-pill" href="{{url('genre/toGenreForm')}}">ジャンルの追加</a>
                    </div>
                    @endif
                    <div class="mt-3 text-center">
                        <a class="btn btn-link" href="{{url('TopPage')}}">Topページへ戻る</a>
                    </div>
                    <!-- モーダルを挿入 -->
                    <div class="modal fade" id="fadeModal" tabindex="-1" aria-labelledby="fadeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">削除内容の確認</h5>
                                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-Label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="text-center">ジャンル名</p>
                                        </div>
                                        <div class="col-8">
                                            <div id="modalTitle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                    <!-- id="modalDelete" を追加 -->
                                    <form action="{{url('genre/deleteGenre', @$genre->genre_id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button id="modalDelete" type="submit" class="btn btn-primary">OK</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('modal.genreModal')
            </div>
        </div>
    </div>
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/modal_genre.js')}}"></script>
    <script src="{{asset('/js/ajax/deleteGenre.js')}}"></script>
</body>

