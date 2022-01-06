<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset('/css/app.css')}}" rel="stylesheet">
<title>BBS</title>
</head>
<body>
    <!-- メインコンテンツここから -->
    <div class="container">
        <div class="row vh-100 align-items-sm-center justify-content-sm-center">
            <div class="card" style="max-width: 500px;">
                <div class="card-body">
                    <h3 class="card-title mb-3 text-center">スレッドの追加</h3>
                    <!-- 入力フォームここから -->
                    <form action="{{url('thread/createThread', $genre->genre_id)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control" id="formTitle" type="text" name="thread_title" placeholder="スレッド名を入力してください">
                            <!-- エラー情報 -->
                            @if($errors->has('thread_title'))
                            <div class="mt-3">
                                <div class="text-danger">{{$errors->first('thread_title')}}</div>
                            </div>
                            @endif
                        </div>
                        <button class="w-100 btn btn-primary text-white" type="button" data-bs-toggle="modal" data-bs-target="#fadeModal">新規スレッドの追加</button>
                        <!-- クリックするとモーダル(入力内容の確認)を表示 -->
                        <!-- モーダルここから -->
                        <div class="modal fade" id="fadeModal" tabindex="-1" aria-labelledby="fadeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">入力内容の確認</h5>
                                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-Label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="text-center">タイトル</p>
                                            </div>
                                            <div class="col-8">
                                                <div id="modalTitle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                        <!-- クリックすると送信 -->
                                        <button class="btn btn-primary text-white" type="submit">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- モーダルここまで -->
                    </form>
                    <h4 class="mt-3 text-center">
                        <a class="btn btn-link" href="{{url('thread/showThread', $genre->genre_id)}}">戻る</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <!-- メインコンテンツここまで -->
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/modal_form.js')}}"></script>
</body>
