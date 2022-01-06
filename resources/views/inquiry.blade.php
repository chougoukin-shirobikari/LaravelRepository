<!-- お問い合わせ一覧ここから -->
<div class="tab-pane fade"
    id="nav-item4" role="tabpanel"
    aria-labelledby="nav-item4-tab">
    @foreach($inquiryList as $inquiry)
    <div class="card mb-3 mt-3">
        <div class="card-body">
            <p class="card-text text-left">
                <span>{{($loop->iteration + ($inquiryList->currentPage() - 1) * 3) . '.'}}</span>
                <span>{{$inquiry->username}}</span>
                <span>{{$inquiry->inquiry_time}}</span>
            </p>
            <p class="card-text text-left">
                <span th:text="${inquiry.message}">{{$inquiry->message}}</span>
                <!-- クリックすると削除 -->
                <!-- dataからjsファイルへ必要な値を渡す -->
                <form id="deleteInquiry" action="{{url('deleteInquiry', $inquiry->inquiry_id)}}" method="POST"
                    data-page={{$inquiryList->currentPage()}}>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link btn-sm">※削除する</button>
                </form>
            </p>
        </div>
    </div>
    @endforeach
    <!-- ページネーションここから -->
    <div id="pagination_inquiry" class="d-flex justify-content-center mt-4">
        {{$inquiryList->links('vendor.pagination.inquiry-pagination')}}
    </div>
</div>
<!-- 会員情報ここまで -->

