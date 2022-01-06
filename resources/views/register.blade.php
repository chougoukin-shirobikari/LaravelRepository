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
        <div class="row vh-100 align-items-md-center justify-content-md-center">
            <div class="card" style="max-width: 600px;">
                <div class="card-body">
                    <h3 class="card-title mv-3 text-center">新規会員登録</h3>
                    <!-- 入力フォームここから -->
                    <form action="{{url('regist')}}" method="POST" novalidate>
                        @csrf
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-center">ユーザー名</p>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="username" placeholder="※必須">
                                    @if($errors->has('username'))
                                    <div class="text-danger">{{$errors->first('username')}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-center">パスワード</p>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="password" placeholder="※必須">
                                    @if($errors->has('password'))
                                    <div class="text-danger">{{$errors->first('password')}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-check mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-center">性別</p>
                                </div>
                                <div class="col-4">
                                    <p>
                                        <input class="form-check-input" type="radio" name="gender" value="0" checked="checked">男性
                                    </p>
                                    <p>
                                        <input class="form-check-input" type="radio" name="gender" value="1">女性
                                    </p>
                                    <p>
                                        <input class="form-check-input" type="radio" name="gender" value="2">その他
                                    </p>
                                    @if($errors->has('gender'))
                                    <div class="text-danger">{{$errors->first('gender')}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- ADMIN権限を持つユーザーが登録されていない場合表示 -->
                        @if($adminExists !== 'yes')
                        <div class="form-group form-check mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-center">権限</p>
                                </div>
                                <div class="col-8">
                                    <input class="form-check-input" type="checkbox" name="role" value="admin">ADMIN(管理者)として登録する
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="mb-3">
                            <button type="submit" class="w-100 btn btn-primary text-white">登録する</button>
                        </div>
                        <div class="mb-3 text-center">
                            <a class="btn btn-link" href="{{url('login')}}">戻る</a>
                        </div>
                    </form>
                    <!-- 入力フォームここまで -->
                </div>
            </div>
        </div>
    </div>
</body>
