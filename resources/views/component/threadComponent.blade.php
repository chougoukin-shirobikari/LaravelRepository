<!-- メインコンテンツここから -->
<div class="row h-100 align-items-center justify-content-center">
    <div class="jumbotron"  style="max-width: 500px;">
        <h3 class="display-3 text-center mt-3 mb-5">{{$genre->genre_title}}</h3>
        <!-- スレッドがまだ一つも作成されていない場合メッセージを表示 -->
        @if(@$deleted === 'yes')
            <div class="alert alert-info text-center">削除が完了しました</div>
        @endif
        @if(count($threadList) === 0 and @$notFound !== 'yes')
        <h4 class="text-center">まだスレッドが作成されていません</h4>
        @endif
        <div class="text-center mb-3">
            <a class="w-50 btn btn-primary rounded-pill text-white" href="{{url('thread/toThreadForm', $genre->genre_id)}}">新規スレッドの追加</a>
        </div>
        <div class="row mb-3">
            <!-- クリックすると画面を更新 -->
            <!-- dataでjsファイルに必要な値を渡す -->
            <div class="col-4">
                <a id="showThread" class="w-100 btn btn-outline-primary rounded-pill btn-sm mx-1"
                    data-genreid={{$genre->genre_id}}
                    href="{{url('thread/showThread', $genre->genre_id)}}">更新</a>
            </div>
            <!-- クリックすると新着順にThreadを表示 -->
            <!-- dataでjsファイルに必要な値を渡す -->
            <div class="col-4">
                @if(isset($keyword))
                <a id="showThreadOrderByCreatedTime" class="w-100 btn btn-outline-primary rounded-pill btn-sm mx-1"
                    data-genreid={{$genre->genre_id}}
                    data-haskeyword="yes"
                    data-sort="orderByCreatedTime"
                    href="/thread/showSearchedThread/orderByCreatedTime/{{$genre->genre_id}}?sort=orderByCreatedTime&keyword={{$keyword}}">新着順</a>
                @else
                <a id="showThreadOrderByCreatedTime" class="w-100 btn btn-outline-primary rounded-pill btn-sm mx-1"
                    data-genreid={{$genre->genre_id}}
                    data-sort="orderByCreatedTime"
                    href="/thread/showThread/orderByCreatedTime/{{$genre->genre_id}}?sort=orderByCreatedTime">新着順</a>
                @endif
            </div>
            <!-- クリックする投稿件数が多い順にThreadを表示 -->
            <!-- dataでjsファイルに必要な値を渡す -->
            <div class="col-4">
                @if(isset($keyword))
                <a id="showThreadOrderByNumberOfPosting"  class="w-100 btn btn-outline-primary rounded-pill btn-sm mx-1"
                    data-genreid={{$genre->genre_id}}
                    data-haskeyword="yes"
                    href="/thread/showSearchedThread/orderByNumberOfPosting/{{$genre->genre_id}}?sort=orderByNumberOfPosting&keyword={{$keyword}}">投稿件数順</a>
                @else
                <a id="showThreadOrderByNumberOfPosting"  class="w-100 btn btn-outline-primary rounded-pill btn-sm mx-1"
                    data-genreid={{$genre->genre_id}}
                    href="/thread/showThread/orderByNumberOfPosting/{{$genre->genre_id}}?sort=orderByNumberOfPosting">投稿件数順</a>
                @endif
            </div>
        </div>
        <!-- 検索フォームここから -->
        <!-- dataでjsファイルに必要な値を渡す -->
        <form id="showSearchedThread" class="input-group mb-3"
            data-genreid={{$genre->genre_id}}
            action="{{url('thread/showSearchedThread', $genre->genre_id)}}" method="GET">
            @csrf
            <input id="keyword" class="form-control" type="text" name="keyword"thread value="{{@$keyword}}" placeholder="スレッドタイトルを入力してください">
            <input id="searchedwords" type="hidden" value="{{@$searchedwords}}">
            <div class="input-group-append">
                <button type="submit" class="input-group-text">検索</button>
            </div>
        </form>
        <!-- 検索フォームここまで -->
        <!-- フォームに空の値が入力されたときはメッセージを表示 -->
        @if(@$isBlank === 'yes')
        <div id="isBlank" class="text-danger" data-isblank={{@$isBlank}}>※スレッドタイトルを入力してください</div>
        @endif
        <!-- ADMIN権限を持つユーザーのみ表示 -->
        <!-- dataでjsファイルに必要な値を渡す -->
        @if(Session::get('role') === 'ADMIN')
        <div class="text-center mb-3">
            <a class="w-100 btn btn-link" id="showUnwritableThread" href="{{url('/URL')}}"
                data-genreid={{$genre->genre_id}}>※投稿可能件数を超えたスレッドを表示</a>
        </div>
        @endif
        <!-- 検索条件に一致するThreadが存在しなかった場合はメッセージを表示 -->
        @if(@$notFound === 'yes')
        <h4 class="alert alert-danger text-center">見つかりませんでした</h4>
        @endif
        @foreach($threadList as $thread)
        <div id="listsize" class="card mb-3" data-listsize={{$loop->count}}>
            <div class="card-body">
                <p id="{{'element' . $loop->index}}" class="card-text text-left">
                    <span>{{$thread->thread_title}}</span>
                    <!-- ADMIN権限を持つユーザのみusernameを表示 -->
                    @if(Session::get('role') === 'ADMIN')
                    <span class="text-danger">{{'*' . $thread->username}}</span>
                    @endif
                </p>
                <hr>
                <p class="card-text text-left">
                    <span>{{$thread->created_time}}</span>
                    @if($thread->number_of_posting > 0)
                    <span class="badge bg-secondary">{{$thread->number_of_posting.'件の投稿'}}</span>
                    @endif
                </p>
                <p class="card-text">
                    <span class="badge bg-primary">
                        <a class="text-white" href="{{url('posting/showPosting', $thread->thread_id)}}">回覧</a>
                    </span>
                    <!-- ADMIN権限を持つユーザのみ表示 -->
                    @if(Session::get('role') === 'ADMIN')
                    <span class="card-text">
                        <button id="modalButton" class="btn btn-link" type="button"
                                data-title="{{$thread->thread_title}}"
                                data-genreid={{$genre->genre_id}}
                                data-threadid={{$thread->thread_id}}
                                data-sort="{{@$sort}}"
                                data-haskeyword="{{@$haskeyword}}"
                                data-keyword="{{@$keyword}}"
                                data-bs-toggle="modal"
                                data-bs-target="#fadeModal">※削除する</button>
                    </span>
                    @endif
                </p>
            </div>
        </div>
        @endforeach
        <!-- モーダルここから -->
        <!-- ページネーションここから -->
        <div id="pagination" class="d-flex justify-content-center mt-4"
            data-haskeyword="{{@$haskeyword}}">
            @if($sort === 'orderByCreatedTime' or $sort === 'orderByNumberOfPosting')
            {{$threadList->appends(['sort' => $sort, 'keyword' => @$keyword])->links('vendor.pagination.thread-pagination')}}
            @else
            {{$threadList->appends(['keyword' => @$keyword])->links('vendor.pagination.thread-pagination')}}
            @endif
        </div>
        <div class="text-center mb-3">
            <a href="{{url('genre/showGenre')}}">戻る</a>
            <!-- ADMIN権限を持っているユーザーのみ表示する -->
            @if(Session::get('role') === 'ADMIN')
            <a href="{{url('toManagement')}}">管理画面へ戻る</a>
            @endif
        </div>
        <div class="mt-3 text-center">
            <a class="btn btn-link" href="{{url('TopPage')}}">Topページへ戻る</a>
        </div>
    </div>
    @include('modal.threadModal')
</div>

