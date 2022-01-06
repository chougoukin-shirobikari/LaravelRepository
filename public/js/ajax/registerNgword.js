/**

NgWordの登録に関するjsファイル

**/

$(document).on('submit', '#registerNgword', function(event){
	event.preventDefault();

	$.ajax({
		type: "POST",
		url: $(this).attr('action'),
		data: {
                ngword: $('#ngword').val(),
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
	})

})
