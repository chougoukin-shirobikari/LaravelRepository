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
        <div id="content">
            <div class="row mt-0 mt-md-5 align-items-center justify-content-center">
                <div class="card" style="max-width: 600px;">
                    <div class="card-header">
                        <p class="mb-1 text-center">返信一覧</p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <span>{{$posting->posting_no.'.'}}</span>
                            <span>{{$posting->name}}</span>
                            <!-- ADMIN権限を持つユーザーのみusernameを表示 -->
                            @if(Session::get('role') === 'ADMIN')
                            <span class="text-danger">{{'*'.$posting->username}}</span>
                            @endif
                            <span>{{$posting->writing_time}}</span>
                        </p>
                        <p class="card-text">
                            <span>{{$posting->message}}</span>
                        </p>
                        <p class="card-text">
                            @if($posting->number_of_reply <= Consts::MAX_NUMBER_OF_REPLY - 1)
                            <a class="badge bg-secondary text-white" href="{{url('/reply/toReplyForm', $posting->posting_id)}}">コメントする</a>
                            @endif
                            <!-- コメントの投稿件数が制限に達した場合に表示 -->
                            @if($posting->number_of_reply > Consts::MAX_NUMBER_OF_REPLY - 1)
                            <span class="badge bg-danger text-white">これ以上コメントできません</span>
                            @endif
                        </p>
                    </div>
                    @foreach($replyList as $reply)
                    <div class="{{$reply->reply_no == session('reply_no_bySeach') ? 'card mb-3 border-danger' : 'card mb-3'}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <span>Re:</span>
                                </div>
                                <div class="col-10">
                                    <p class="card-text">
                                        <span>{{$reply->reply_no.'.'}}</span>
                                        <span>{{$reply->name}}</span>
                                        <!-- ADMIN権限を持つユーザーのみ表示 -->
                                        @if($reply->name !== '削除済み' and Session::get('role') === 'ADMIN')
                                        <span class="text-danger">{{'*'.$reply->username}}</span>
                                        @endif
                                        <span>{{$reply->reply_time}}</span>
                                    </p>
                                    <p class="card-text">
                                        <span>{{$reply->reply_message}}</span>
                                        <!-- ADMIN権限を持つユーザのみ表示 -->
                                        <!-- dataでjsファイルに必要な値を渡す -->
                                        <!-- クリックするとモーダル(削除内容の確認)を表示 -->
                                        @if($reply->name !== '削除済み' and Session::get('role') === 'ADMIN')
                                        <span>
                                            <button id="modalButton" class="btn btn-link btn-sm" type="button"
                                                data-replyid={{$reply->reply_id}}
                                                data-postingid={{$reply->posting_id}}
                                                data-no="{{$reply->reply_no.'.'}}"
                                                data-name="{{$reply->name}}"
                                                data-time="{{$reply->reply_time}}"
                                                data-message="{{$reply->reply_message}}"
                                                data-bs-target="#fadeModal" data-bs-toggle="modal">※削除する</button>
                                        </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 mb-5 text-center">
                    <span>
                        <a href="{{url('posting/showPosting', $posting->thread_id)}}">戻る</a>
                    </span>
                    <!-- ADMIN権限を持つユーザーのみ表示 -->
                    @if(Session::get('role') === 'ADMIN')
                    <span>
                        <a href="{{url('toManagement')}}">管理画面へ戻る</a>
                    </span>
                    @endif
                    <div class="mt-3 text-center">
                        <a class="btn btn-link" href="{{url('TopPage')}}">Topページへ戻る</a>
                    </div>
                </div>
                <!-- モーダルここから -->
                @include('modal.replyModal')
                <!-- モーダルここまで -->
            </div>
        </div>
    </div>
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/modal_reply.js')}}"></script>
    <script src="{{asset('/js/ajax/deleteReply.js')}}"></script>
    <!-- メインコンテンツここまで -->
</body>
</html>
