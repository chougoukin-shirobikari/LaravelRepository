/**

Imageの削除に関するjsファイル

**/

$(document).on('click', '#deleteImage', function(event){
	event.preventDefault();
	let postingId = $('#imageModalButton').data('postingid');
    let Url = $('#deleteImageForm').attr('action');
    let haskeyword = $('#deleteImageForm').data('haskeyword');

	$.ajax({
		type: "DELETE",
		url: Url,
		data: {
            _token: $("*[name=_token]").val(),
            page: $('#deleteImageForm').data('page')
		    },
		dataType: "html"
	}).done(function(data, status, xhr){
		$('#content').html(data);
		$("#imageModal").modal('hide');
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
	})

})
