<!-- 削除内容を確認するモーダル -->
<div class="modal fade" id="fadeModal" tabindex="-1" aria-labelledby="fadeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">削除内容の確認</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-Label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="text-left">
                        <span id="modalNo"></span>
                        <span id="modalName"></span>
                        <span id="modalTime"></span>
                    </div>
                    <div class="text-left">
                        <span id="modalMessage"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- クリックすると削除 -->
                <!-- dataでjsファイルに必要な値を渡す -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                <form id="modalDelete" action="/URL" method="POST"
                    data-haskeyword="{{@$haskeyword}}"
                    data-page={{$postingList->currentPage()}}
                    data-total={{$postingList->total()}}>
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-primary text-white" type="submit">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 削除内容を確認するモーダルここまで -->
