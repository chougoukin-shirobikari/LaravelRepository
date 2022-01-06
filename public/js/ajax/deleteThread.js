/**

Threadの削除に関するjsファイル

**/

$(document).on('click','#modalDelete', function(event){
	event.preventDefault();
	let Url = $(event.currentTarget).attr('action');
	let haskeyword = $('#modalDelete').data('haskeyword');

	$.ajax({
		type: "DELETE",
		url : Url,
		data: {_token: $("*[name=_token]").val(),
                page : $('#modalDelete').data('page'),
                total : $('#modalDelete').data('total')
		       },
		dataType: "html"
	}).done(function(data, status, xhr){
			$('#content').html(data);
			$("#fadeModal").modal('hide');
			$("body").removeClass("modal-open");
			$("body").removeAttr("style");
			$('.modal-backdrop').remove();

            if(haskeyword === 'yes'){
                highlight();
            }
			console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
			console.log(XMLHttpRequest);
			console.log(status);
			console.log(errorThrown);
	});

});
