<!-- 会員情報ここから -->
<div class="tab-pane fade"
    id="nav-item3" role="tabpanel"
    aria-labelledby="nav-item3-tab">
    <!-- 検索フォームここから -->
    <form id="searchUesrname" class="input-group mt-3 mb-1" action="{{url('searchUsername')}}" method="POST">
        @csrf
        <input id="username" class="form-control" type="text" name="username" placeholder="ユーザー名を入力してください">
        <div class="input-group-append">
            <button type="submit" class="input-group-text">検索</button>
        </div>
    </form>
    <!-- 検索フォームここまで -->
    <div class="row">
        <div class="col-4">
            <!-- クリックすると画面を更新 -->
            <a id="toUserInfo" class="w-100 btn btn-outline-primary rounded-pill btn-sm mt-2">更新</a>
        </div>
        <div class="col-8">
            <!-- クリックすると３カ月間書き込みのないユーザーを表示 -->
            <!-- th:dataでjsファイルに必要な値を渡す -->
            <a id="searchGhostUser" class="w-100 btn btn-outline-primary rounded-pill btn-sm mt-2">３カ月間書き込みのないユーザーを表示する</a>
        </div>
    </div>
    <!-- 条件に一致するユーザーが存在しない場合はメッセージを表示 -->
    @if(@$notFound === 'yes')
    <div class="alert alert-danger text-center mt-3">見つかりませんでした</div>
    @endif
    @if(count($userInfoList) > 0)
    <div class="table-responsive">
        <table class="table table-bordered text-nowrap mt-3">
            <thead class="table-primary">
                <tr>
                    <th style="width: 30%">username</th>
                    <th style="width: 15%">gender</th>
                    <th style="width: 15%">role</th>
                    <th style="width: 30%">last writing time</th>
                    <th style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($userInfoList as $userInfo)
                <tr>
                    <td>{{$userInfo->username}}</td>
                    <td>{{$userInfo->gender}}</td>
                    <td>{{$userInfo->role}}</td>
                    <td>{{$userInfo->last_writing_time}}</td>
                    <!-- クリックすると削除 -->
                    <td>
                        <form id="deleteUserInfo" action="{{url('deleteUserInfo', $userInfo->user_id)}}" method="POST"
                            data-userid={{$userInfo->user_id}}
                            data-showghostuser="{{@$showGhostUser}}"
                            data-page={{$userInfoList->currentPage()}}>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link">※削除する</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <!-- ページネーションここから -->
    <div id="pagination_userinfo" class="d-flex justify-content-center mt-4">
        {{$userInfoList->links('vendor.pagination.userInfo-pageination')}}
    </div>

</div>
<!-- 会員情報ここまで -->
