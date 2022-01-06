<!-- NGワード関連一覧ここから -->
<div class="tab-pane fade"
    id="nav-item2" role="tabpanel"
    aria-labelledby="nav-item2-tab">
    <div class="row">
        @foreach($ngwordList as $ngword)
        <div class="col-3 mt-3">
            <span class="w-100 btn btn-danger rounded-pill text-white">{{$ngword->ngword}}</span>
            <div class="text-center">
                <form id="deleteNgword" action="{{url('deleteNgword', $ngword->ngword_id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link">※削除する</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <!-- NGワードの入力フォーム -->
    <form id="registerNgword" action="{{url('registerNgword')}}" method="POST">
        @csrf
        <div class="text-center mt-3">
            <input id="ngword" type="text" name="ngword">
            <!-- 入力にエラーがあった場合メッセージを表示 -->
            @if(isset($ngword_error))
            <div class="mt-3">
                <div class="text-danger">※入力エラーです</div>
            </div>
            @endif
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-secondary btn-sm" type="submit">NGワードを追加</button>
        </div>
    </form>
</div>
<!-- NGワード関連一覧ここまで -->
