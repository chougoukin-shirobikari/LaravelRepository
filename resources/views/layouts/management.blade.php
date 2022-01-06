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
            <div class="card" style="min-width: 500px; max-width: 600px;">
                <div class="card-body">
                    <div class="card-title">
                        <h2 class="text-center">管理画面</h2>
                    </div>
                    <hr>
                    <!-- タブの一覧ここから -->
                    <!-- コントローラーから渡されたパラメータで表示を切り替える -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="{{($ngword !== 'ngword' and $userInfo !== 'userInfo' and $inquiry !== 'inquiry') ? 'nav-link active' : 'nav-link'}}"
                                id="nav-item1-tab"
                                data-bs-toggle="tab" href="#nav-item1" role="tab"
                                aria-controls="nav-item1" aria-selected="true">
                                <span>検索関連</span>
                            </a>
                            <a class="{{($ngword === 'ngword' and $userInfo !== 'userInfo' and $inquiry !== 'inquiry') ? 'nav-link active' : 'nav-link'}}"
                                id="nav-item2-tab"
                                data-bs-toggle="tab" href="#nav-item2" role="tab"
                                aria-controls="nav-item2" aria-selected="false">NGワード関連
                            </a>
                            <a class="{{($userInfo === 'userInfo' and $ngword !== 'ngword' and $inquiry !== 'inquiry') ? 'nav-link active' : 'nav-link'}}"
                                id="nav-item3-tab"
                                th:data-currentpage="${0}" data-bs-toggle="tab" href="#nav-item3" role="tab"
                                aria-controls="nav-item3" aria-selected="false">会員情報
                            </a>
                            <a class="{{($inquiry === 'inquiry' and $userInfo !== 'userInfo' and $ngword !== 'ngword') ? 'nav-link active' : 'nav-link'}}"
                                id="nav-item4-tab"
                                th:data-currentpage="${0}" data-bs-toggle="tab" href="#nav-item4" role="tab"
                                aria-controls="nav-item4" aria-selected="false">お問い合わせ
                            </a>
                        </div>
                    </nav>
                    <!-- タブの一覧ここまで -->
                    <div class="tab-content" id="nav-tabContent">
                        <!-- 検索関連ここから -->
                        <div id="searchscreen">
                            <div class="tab-pane fade show active"
                                id="nav-item1" role="tabpanel"
                                aria-labelledby="nav-item1-tab">
                                <div>
                                    <button class="w-25 btn btn-primary text-white mt-3"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#example-1"
                                        aria-expanded="false"
                                        aria-controls="example-1">Posting</button>
                                    <!-- コントローラーから渡されたパラメータで表示を切り替える -->
                                    <div class="{{(session('collapse') == 1) ? 'collapse show' : 'collapse'}}" id="example-1">
                                        <div class="card card-body">
                                            <!-- 入力フォームここから -->
                                            <form action="{{url('searchPosting')}}" method="POST">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-center">GenreTitle</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" name="genre_title" placeholder="※必須">
                                                            @if($errors->has("genre_title") and (session('collapse') == 1))
                                                            <div class="mt-3">
                                                                <div class="text-danger">{{$errors->first('genre_title')}}</div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-center">ThreadTitle</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" name="thread_title" placeholder="※必須">
                                                            @if($errors->has("thread_title") and (session('collapse') == 1))
                                                            <div class="mt-3">
                                                                <div class="text-danger">{{$errors->first('thread_title')}}</div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-center">PostingNo</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" name="posting_no" placeholder="※必須">
                                                            @if($errors->has("posting_no") and (session('collapse') == 1))
                                                            <div class="mt-3">
                                                                <div class="text-danger">{{$errors->first('posting_no')}}</div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- TODO -->
                                                <!-- 条件に一致するPostingが存在しなかった場合はメッセージを表示 -->
                                                @if(session('postingNotFound') === 'yes')
                                                <div class="alert alert-danger text-center">見つかりませんでした</div>
                                                @endif
                                                <button class="btn btn-secondary" type="submit">検索</button>
                                            </form>
                                            <!-- 入力フォームここまで -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Reply検索ここから -->
                                <div>
                                    <button class="w-25 btn btn-primary text-white mt-3"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#example-2"
                                        aria-expanded="false"
                                        aria-controls="example-2">Reply</button>
                                    <!-- コントローラーから渡されたパラメータで表示を切り替える -->
                                    <div class="{{(session('collapse') == 2) ? 'collapse show' : 'collapse'}}" id="example-2">
                                        <div class="card card-body">
                                            <!-- 入力フォームここから -->
                                            <form action="{{url('searchReply')}}" method="POST">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-center">GenreTitle</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" name="genre_title" placeholder="※必須">
                                                            @if($errors->has("genre_title") and (session('collapse') == 2))
                                                            <div class="mt-3">
                                                                <div class="text-danger">{{$errors->first("genre_title")}}</div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-center">ThreadTitle</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" name="thread_title" placeholder="※必須">
                                                            @if($errors->has("thread_title") and (session('collapse') == 2))
                                                            <div class="mt-3">
                                                                <div class="text-danger">{{$errors->first('thread_title')}}</div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-center">PostingNo</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" name="posting_no" placeholder="※必須">
                                                            @if($errors->has("posting_no") and (session('collapse') == 2))
                                                            <div class="mt-3">
                                                                <div class="text-danger">{{$errors->first('posting_no')}}</div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-center">ReplyNo</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" name="reply_no" placeholder="※必須">
                                                            @if($errors->has("reply_no") and (session('collapse') == 2))
                                                            <div class="mt-3">
                                                                <div class="text-danger">{{$errors->first('reply_no')}}</div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- TODO -->
                                                <!-- 条件に一致するReplyが存在しなかった場合はメッセージを表示 -->
                                                @if(session('replyNotFound') === 'yes')
                                                <div class="alert alert-danger text-center">見つかりませんでした</div>
                                                @endif
                                                <button class="btn btn-secondary" type="submit">検索</button>
                                            </form>
                                            <!-- 入力フォームここまで -->
                                        </div>
                                    </div>
                                </div>
                                <!-- 検索関連ここまで -->
                            </div>
                        </div>
                        <!-- NGワード関連ここから -->
                        <div id="ngwordscreen"></div>
                        <!-- 会員情報ここから -->
                        <div id="userinfoscreen"></div>
                        <!-- お問い合わせ一覧ここから -->
                        <div id="inquiryscreen"></div>
                        <hr>
                        <div class="text-center mb-2">
                            <a class="btn btn-link" href="{{url('TopPage')}}">戻る</a>
                        </div>
                        <!-- Postリクエストでログアウトするためformタグを使用 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- メインコンテンツここまで -->
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/paginate_userInfo.js')}}"></script>
    <script src="{{asset('/js/paginate_inquiry.js')}}"></script>
    <script src="{{asset('js/ajax/toSearcScreen.js')}}"></script>
    <script src="{{asset('js/ajax/toNgwordScreen.js')}}"></script>
    <script src="{{asset('js/ajax/registerNgword.js')}}"></script>
    <script src="{{asset('js/ajax/deleteNgword.js')}}"></script>
    <script src="{{asset('js/ajax/toUserInfoScreen.js')}}"></script>
    <script src="{{asset('js/ajax/deleteUserInfo.js')}}"></script>
    <script src="{{asset('js/ajax/searchUsername.js')}}"></script>
    <script src="{{asset('js/ajax/searchGhostUser.js')}}"></script>
    <script src="{{asset('js/ajax/toInquiryScreen.js')}}"></script>
    <script src="{{asset('js/ajax/deleteInquiry.js')}}"></script>
</body>
