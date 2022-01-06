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
        <div class="row vh-100 align-items-md-center justify-content-md-center">
            <div class="jumbotron bg-white" style="max-width: 600px;">
                <h1 class="display-1 text-center mt-5 mt-md-0">BBS</h1>
                <h2 class="display-4 mb-3 text-center">-- Welcom to BBS! --</h2>
                <h3 class="mb-3 text-center">
                    <a class="w-50 btn btn-primary rounded-pill text-white" href="{{url('genre/showGenre')}}">掲示板を利用する</a>
                </h3>
                <h3 class="mb-3 text-center">
                    <a class="w-50 btn btn-outline-primary rounded-pill" href="{{url('toInquiryForm')}}">お問い合わせ</a>
                </h3>
                <!-- ADMIN権限を持っているユーザーのみ表示 -->
                @if(Session::get('role') === 'ADMIN')
                <h6 class="mb-1 text-center">
                    <a class="btn btn-link" href="{{url('toManagement')}}">管理画面へ</a>
                </h6>
                @endif
                <!-- Postリクエストでログアウトするためformタグを使用 -->
                <form class="text-center" action="{{url('logout')}}" name="logout" method="post">
                    @csrf
                    <a class="btn btn-link" href="javascript:logout.submit()">ログアウトする</a>
                </form>
            </div>
        </div>
    </div>
    <!-- メインコンテンツここまで -->
</body>
</html>
