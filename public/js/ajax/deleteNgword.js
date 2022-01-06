/**

NgWordの削除に関するjsファイル

**/

$(document).on('click', '#deleteNgword', function(event){
	event.preventDefault();

	$.ajax({
		type: "DELETE",
		url: $(this).attr('action'),
        data: {
            _token: $("*[name=_token]").val()
		    },
		dataType: "html"
	}).done(function(data, status, xhr){
		$('#ngwordscreen').html(data);
        $('#nav-item1').hide();
        $('#nav-item2').attr('class', 'tab-pane fade show active');
        $('#nav-item3').hide();
        $('#nav-item4').hide();
		console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
		console.log(XMLHttpRequest);
		console.log(status);
		console.log(errorThrown);
	}).always(() => {
		$('#nav-item2-tab').removeAttr('disabled');
	})
})
