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
            <div class="card" style="max-width: 480px;">
                <div class="card-body">
                    <h3 class="card-title mb-3 text-center">ログイン画面</h3>
                    <!-- 新規登録が完了した場合はメッセージを表示 -->
                    @if(session('success') === 'success')
                    <div class="alert alert-info text-center">登録が完了しました</div>
                    @endif
                    <!-- 入力フォームここから -->
                    <form action="{{url('Authentication')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control" type="text" name="username" placeholder="ユーザー名">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="password" name="password" placeholder="パスワード">
                        </div>
                        <button class="w-100 btn btn-primary text-white" type="submit">ログイン</button>
                    </form>
                    <!-- 入力フォームここまで -->
                    <div class="mt-3 text-center">
                        <a class="btn btn-link" href="{{url('/toRegister')}}">新規登録はこちらから</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- メインコンテンツここまで -->
</body>
