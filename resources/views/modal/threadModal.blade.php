<!-- 削除内容の確認をするモーダル -->
<div class="modal fade" id="fadeModal" tabindex="-1" aria-labelledby="fadeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">削除内容の確認</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-Label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <p class="text-center">スレッド名</p>
                    </div>
                    <div class="col-8">
                        <div id="modalTitle"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                <!-- クリックすると削除 -->
                <!-- dataでjsファイルに必要な値を渡す -->
                <form id="modalDelete" action="/URL" method="POST"
                    data-page={{$threadList->currentPage()}}
                    data-total={{$threadList->total()}}
                    data-haskeyword="{{@$haskeyword}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary text-white" type="submit">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 削除内容を確認するモーダルここまで -->
