<!-- 画像を表示するモーダルここから -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="fadeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">投稿された画像</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-Label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="image" style="max-width: 100%; height: auto;" src="/URL">
            </div>
            <div class="modal-footer">
                <!-- ADMIN権限を持つユーザーのみ表示 -->
                <form id="deleteImageForm" action="{{url('posting/deletePostingImage', @$posting->posting_id)}}" method="POST"
                    data-haskeyword="{{@$haskeyword}}"
                    data-page={{$postingList->currentPage()}}>
                    @csrf
                    @method('DELETE')
                    <button id="deleteImage" class="btn btn-secondary" type="submit">※画像を削除する</button>
                </form>
                <!-- inputでdataを送る
                <a class="btn btn-primary" id="deleteImage"
                    th:data-currentpage="${pageInfo.currentpage}"
                    th:data-bysearch="${bySearch}"
                    th:data-order="${orderBy}"
                    th:href="@{/}" th:text="${'※画像を削除する'}"></a>
                -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
