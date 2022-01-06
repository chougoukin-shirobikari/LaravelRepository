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
        <div class="row vh-100 align-items-center justify-content-md-center">
            <div class="card" style="max-width: 700px;">
                <div class="card-body">
                    <h3 class="card-title mb-3 text-center">ジャンルの追加</h3>
                    <!-- 入力フォームここから -->
                    <form action="{{url('genre/createGenre')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control" id="formTitle"  type="text" name="genre_title" placeholder="ジャンルを入力してください">
                        </div>
                        <!-- エラー情報を表示 -->
                        @if($errors->has('genre_title'))
                        <div class="mb-3">
                            <div class="text-danger">{{$errors->first('genre_title')}}</div>
                        </div>
                        @endif
                        <button class="w-100 btn btn-primary text-white" type="button" data-bs-toggle="modal" data-bs-target="#fadeModal">新規ジャンルの追加</button>
                        <!-- モーダルを挿入 -->
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
                                        <button class="btn btn-primary text-white" type="submit">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- モーダルここまで -->
                    </form>
                    <!-- 入力フォームここまで -->
                    <div class="mt-3 mb-3 text-center">
                        <a class="btn btn-link" href="{{url('genre/showGenre')}}">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/modal_form.js')}}"></script>
</body>
