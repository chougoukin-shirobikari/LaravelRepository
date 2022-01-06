<!-- モーダルを挿入 -->
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
                        <p class="text-center">ジャンル名</p>
                    </div>
                    <div class="col-8">
                        <div id="modalTitle"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                <!-- id="modalDelete" を追加 -->
                <form  id="modalDelete" action="/URL" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary text-white">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>
