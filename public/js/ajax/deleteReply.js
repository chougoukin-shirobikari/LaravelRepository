/**

Genre, Replyの削除に関するjsファイル

**/

$(document).on('click','#modalDelete', function(event){
	event.preventDefault();
	let Url = $(event.currentTarget).attr('action');

	$.ajax({
		type: "PATCH",
		url : Url,
		data: {
            _token: $("*[name=_token]").val()
            },
		dataType: "html"
	}).done(function(data, status, xhr){
			$('#content').html(data);
			$("#fadeModal").modal('hide');
			$("body").removeClass("modal-open");
			$("body").removeAttr("style");
			$('.modal-backdrop').remove();
			console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
			console.log(XMLHttpRequest);
			console.log(status);
			console.log(errorThrown);
	});

})
