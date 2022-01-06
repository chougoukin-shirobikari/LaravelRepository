/**

Inquiryの削除に関するjsファイル

**/

$(document).on('click', '#deleteInquiry', function(event){
	event.preventDefault();

	$.ajax({
		type: "DELETE",
        url: $(this).attr('action'),
        data: {
            _token: $("*[name=_token]").val(),
            page: $(this).data('page')
		    },
		dataType: "html"
	}).done(function(data, status, xhr){
		$('#inquiryscreen').html(data);
        $('#nav-item1').hide();
        $('#nav-item2').hide();
        $('#nav-item3').hide();
        $('#nav-item4').attr('class', 'tab-pane fade show active');
		console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
		console.log(XMLHttpRequest);
		console.log(status);
		console.log(errorThrown);
	})

})
