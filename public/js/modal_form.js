/**

モーダルの表示(入力内容の確認)に関するjsファイル

**/

$(function(){
	$('#fadeModal').on('show.bs.modal', function(){
		let title = $('#formTitle').val()
		let modal = $(this)

		modal.find('#modalTitle').text(title)
	})
})
