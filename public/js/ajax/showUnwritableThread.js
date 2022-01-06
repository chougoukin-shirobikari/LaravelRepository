/**

これ以上投稿できないThreadの表示に関するjsファイル

**/


$(document).on('click','#showUnwritableThread', function(event){
	event.preventDefault();
	let genreId = $(this).data('genreid');
	let Url = "/thread/showUnwritableThread/" + genreId;

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
	})

});
