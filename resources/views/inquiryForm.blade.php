<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset('/css/app.css')}}" rel="stylesheet">
<link href="{{asset('/css/style.css')}}" rel="stylesheet">
<title>BBS</title>
</head>
<body>
    <!-- メインコンテンツここから -->
    <div class="container">
        <div class="row vh-100 align-items-md-center justify-content-md-center">
            <div class="card" style="max-width: 600px;">
                <div class="card-body">
                    <!-- 送信が成功した場合メッセージを表示 -->
                    @if(session('success') === 'success')
                    <div class="alert alert-info text-center">送信が完了しました</div>
                    @endif
                    <h3 class="card-title mb-3 text-center">お問い合わせフォーム</h3>
                    <!-- 入力フォームここから -->
                    <form action="{{url('makeAnInquiry')}}" method="post" novalidate>
                        @csrf
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-center">ユーザー名</p>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" id="formName" name="username" placeholder="※必須">
                                    @if($errors->has('username'))
                                    <div class="mt-3">
                                        <div class="text-danger">{{$errors->first('username')}}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-center">お問い合わせ内容</p>
                                </div>
                                <div class="col-8">
                                    <textarea class="form-control" id="formMessage" name="message" rows="4" cols="40" placeholder="※必須"></textarea>
                                    @if($errors->has('message'))
                                    <div class="mt-3">
                                        <div class="text-danger">{{$errors->first('message')}}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <!-- クリックするとモーダル(入力内容の確認)を表示 -->
                            <button type="button" class="w-100 btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#fadeModal">確認</button>
                        </div>
                        <div class="mb-3 text-center">
                            <a class="btn btn-link" href="{{url('TopPage')}}">戻る</a>
                        </div>
                        <!-- モーダルここから -->
                        <div class="modal fade" id="fadeModal" tabindex="-1" aria-labelledby="fadeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">入力内容の確認</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="text-center">ユーザー名</p>
                                            </div>
                                            <div class="col-8">
                                                <div id="modalName"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="text-center">お問い合わせ内容</p>
                                            </div>
                                            <div class="col-8">
                                                <div id="modalMessage"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                        <button class="btn btn-primary text-white" type="submit" id="button">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- モーダルここまで -->
                    </form>
                    <!-- 入力フォームここまで -->
                </div>
            </div>
        </div>
    </div>
    <!-- メインコンテンツここまで -->
    <!-- スピナーここから -->
    <div id="overlay">
        <div class="cv-spinner">
        <span class="spinner"></span>
        </div>
    </div>
    <!-- スピナーここまで -->
</body>
<script src="{{asset('/js/app.js')}}"></script>
<script src="{{asset('/js/spinner.js')}}"></script>
<script src="{{asset('/js/modal_inquiryForm.js')}}"></script>
</html>
