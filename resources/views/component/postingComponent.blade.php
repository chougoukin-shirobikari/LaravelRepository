<!-- メインコンテンツここから -->
<div class="row mt-5 align-items-center justify-content-center">
    <div class="jumbotron" style="max-width: 500px;">
        <h3 class="display-3 text-center mt-3 mb-5">{{$thread->thread_title}}</h3>
        @if(@$deleted === 'yes')
        <div class="alert alert-info text-center">削除が完了しました</div>
        @endif
        @if(count($postingList) === 0)
        <h4 class="text-center">まだ書き込みがありません</h4>
        @endif
        <!-- クリックするとフォーム画面へ -->
        <!-- Postingの投稿件数が制限に達していた場合表示しない -->
        @if($thread->number_of_posting <= Consts::MAX_NUMBER_OF_POSTING - 1)
        <div class="text-center mb-3">
            <a class="w-50 btn btn-primary rounded-pill text-white" href="{{url('posting/toPostingForm', $thread->thread_id)}}">メッセージを投稿する</a>
        </div>
        @endif
        <!-- Postingの投稿件数が制限に達した場合メッセージを表示 -->
        @if($thread->number_of_posting > Consts::MAX_NUMBER_OF_POSTING - 1)
        <div class="text-center mb-3">
            <span class="w-50 btn btn-danger rounded-pill text-white">これ以上投稿できません</span>
        </div>
        @endif
        <div class="row mb-3 mt-3">
            <div class="row">
                <div class="col-4">
                    <!-- クリックすると画面を更新 -->
                    <!-- dataでjsファイルに必要な値を渡す -->
                    <a id="showPosting" class="w-100 btn btn-outline-primary rounded-pill btn-sm mx-1"
                        data-threadid={{$thread->thread_id}}
                        href="{{url('posting/showPosting', $thread->thread_id)}}">更新</a>
                </div>
                <div class="col-4">
                    <!-- クリックすると新着順に表示 -->
                    <!-- dataでjsファイルに必要な値を渡す -->
                    @if(isset($keyword))
                    <a id="showPostingOrderByCreatedTime" class="w-100 btn btn-outline-primary rounded-pill btn-sm mx-1"
                        data-threadid={{$thread->thread_id}}
                        data-haskeyword="yes"
                        data-sort="orderByCreatedTime"
                        href="/posting/showSearchedPosting/orderByCreatedTime/{{$thread->thread_id}}?keyword={{$keyword}}">新着順</a>
                    @else
                    <a id="showPostingOrderByCreatedTime" class="w-100 btn btn-outline-primary rounded-pill btn-sm mx-1"
                        data-threadid={{$thread->thread_id}}
                        data-sort="orderByCreatedTime"
                        href="/posting/showPosting/orderByCreatedTime/{{$thread->thread_id}}">新着順</a>
                    <!-- TODO data-sort={{$sort}} -->
                    @endif
                </div>
                <div class="offset-4"></div>
            </div>
        </div>
        <!-- 検索フォームここから -->
        <!-- dataでjsファイルに必要な値を渡す -->
        <form id="showSearchedPosting" class="input-group mb-3"
            data-threadid={{$thread->thread_id}}
            action="{{url('posting/showSearchedPosting', $thread->thread_id)}}" method="GET">
            @csrf
            <input id="keyword" class="form-control" type="text" name="keyword" value="{{@$keyword}}" placeholder="キーワードを入力してください">
            <input id="searchedwords" type="hidden" value="{{@$searchedwords}}">
            <div class="input-group-append">
                <button type="submit" class="input-group-text">検索</button>
            </div>
        </form>
        <!-- 検索フォームここまで -->
        <!-- フォームに空の値が入力されたときはメッセージを表示 -->
        @if(@$isBlank === 'yes')
        <div id="isBlank" class="text-danger mb-3" data-isblank={{@$isBlank}}>※キーワードを入力してください</div>
        @endif
        <!-- 条件に一致するPostingが存在しなかった場合メッセージを表示 -->
        @if(@$notFound === 'yes')
        <h4 class="alert alert-danger text-center">見つかりませんでした</h4>
        @endif
        @foreach($postingList as $posting)
        <div id="listsize" data-listsize={{$loop->count}}
            class="{{$posting->posting_no == session('posging_no_bySeach') ? 'card mb-3 border-danger' : 'card mb-3'}}">
            <div class="card-body">
                <p class="card-text text-left">
                    <span>{{$posting->posting_no.'.'}}</span>
                    <span>{{$posting->name}}</span>
                    <!-- ADMIN権限を持つユーザにのみ表示 -->
                    @if($posting->name !== '削除済み' and Session::get('role') === 'ADMIN')
                    <span class="text-danger">{{'*'.$posting->username}}</span>
                    @endif
                    <span>{{$posting->writing_time}}</span>
                    @if($posting->number_of_reply > 0 and $posting->name !== '削除済み')
                    <span class="badge bg-secondary">
                        <a class="text-white" href="{{url('reply/showReply', $posting->posting_id)}}">{{'コメント'.$posting->number_of_reply.'件'}}</a>
                    </span>
                    @endif
                </p>
                <p id="{{'element' . $loop->index}}" class="card-text text-left">
                    <span>{{$posting->message}}</span>
                </p>
                <!-- クリックすると画像をモーダルで表示 -->
                <!-- dataでjsファイルに必要な値を渡す -->
                @if($posting->has_image === 1)
                <p class="card-text text-left">
                    <button id="imageModalButton" class="btn btn-outline-primary btn-sm" type="button"
                        data-postingid={{$posting->posting_id}}
                        data-sort="{{@$sort}}"
                        data-haskeyword="{{@$haskeyword}}"
                        data-keyword="{{@$keyword}}"
                        data-bs-target= "#imageModal"
                        data-bs-toggle="modal">画像を表示する</button>
                </p>
                @endif
                @if($posting->name !== '削除済み')
                @if($posting->number_of_reply <= Consts::MAX_NUMBER_OF_REPLY - 1)
                <a class="badge bg-primary text-white" href="{{url('reply/toReplyForm', $posting->posting_id)}}">コメントする</a>
                @endif
                @if($posting->number_of_reply > Consts::MAX_NUMBER_OF_REPLY - 1)
                <span class="badge bg-danger text-white">これ以上コメントできません</span>
                @endif
                @endif
                @if($posting->name !== '削除済み' and Session::get('role') === 'ADMIN')
                <span>
                    <!-- ADMIN権限を持つユーザのみ表示 -->
                    <!-- クリックするとモーダル(削除内容の確認)を表示 -->
                    <!-- dataでjsファイルに必要な値を渡す -->
                    <button id="modalButton" class="btn btn-link" type="button"
                            data-postingid={{$posting->posting_id}}
                            data-threadid={{$thread->thread_id}}
                            data-no="{{$posting->posting_no.'.'}}"
                            data-name="{{$posting->name}}"
                            data-time="{{$posting->writing_time}}"
                            data-message="{{$posting->message}}"
                            data-sort="{{@$sort}}"
                            data-haskeyword="{{@$haskeyword}}"
                            data-keyword="{{@$keyword}}"
                            data-bs-target= "#fadeModal" data-bs-toggle="modal">※投稿を削除する</button>
                </span>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <!-- ページネーションここから -->
    <div id="pagination" class="d-flex justify-content-center mt-4"
        data-haskeyword="{{@$haskeyword}}">
        @if($sort === 'orderByCreatedTime')
        {{$postingList->appends(['sort' => $sort, 'keyword' => @$keyword])->links('vendor.pagination.posting-pagination')}}
        @else
        {{$postingList->appends(['keyword' => @$keyword])->links('vendor.pagination.posting-pagination')}}
        @endif
    </div>
</div>
<div class="mt-4 mb-5 text-center">
    <a href="{{url('thread/showThread', $thread->genre_id)}}">戻る</a>
    @if(Session::get('role') === 'ADMIN')
    <a href="{{url('toManagement')}}">管理画面へ戻る</a>
    @endif
    <div class="mt-3 text-center">
        <a class="btn btn-link" href="{{url('TopPage')}}">Topページへ戻る</a>
    </div>
</div>
<!-- モーダルここから -->
@include('modal.postingModal')
@include('modal.imageModal')
<!-- メインコンテンツここまで -->
