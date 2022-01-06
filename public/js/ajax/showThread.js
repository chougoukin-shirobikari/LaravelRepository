/**

Threadの表示に関するjsファイル

**/


$(document).on('click','#showThread', function(event){
	event.preventDefault();
	let genreId = $(this).data('genreid');
	let Url = "/thread/showThreadByAjax/" + genreId;

	$.ajax({
		type: "GET",
		url : Url,
		dataType: "html"
	}).done(function(data, status, xhr){
			$('#content').html(data);
			console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
			console.log(XMLHttpRequest);
			console.log(status);
			console.log(errorThrown);
	});

});
