/**

ユーザーの検索に関するjsファイル

**/

$(document).on('submit', '#searchUesrname', function(event){
	event.preventDefault();

	$.ajax({
		type: "POST",
		url: $('#searchUesrname').attr('action'),
		data: {
                username: $('#username').val(),
		       _token: $("*[name=_token]").val()
            },
		dataType: "html"
	}).done(function(data, status, xhr){
		$('#userinfoscreen').html(data);
        $('#nav-item1').hide();
        $('#nav-item2').hide();
        $('#nav-item3').attr('class', 'tab-pane fade show active');
        $('#nav-item4').hide();
		console.log('ajax')
	}).fail(function(XMLHttpRequest, status, errorThrown){
        console.log($(this).attr('action'))
		console.log(XMLHttpRequest);
		console.log(status);
		console.log(errorThrown);
	});
});
