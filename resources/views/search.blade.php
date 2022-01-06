<!--
-->
<!-- 検索関連ここから -->
<!-- Posting検索ここから -->
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
                                @if($errors->has("genre_title"))
                                <div class="mt-3">
                                    <div class="text-danger">{{$errors->first('genre_title') and (session('collapse') == 1)}}</div>
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
                                @if($errors->has("thread_title"))
                                <div class="mt-3">
                                    <div class="text-danger">{{$errors->first('thread_title') and (session('collapse') == 1)}}</div>
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
                                @if($errors->has("posting_no"))
                                <div class="mt-3">
                                    <div class="text-danger">{{$errors->first('posting_no') and (session('collapse') == 1)}}</div>
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
