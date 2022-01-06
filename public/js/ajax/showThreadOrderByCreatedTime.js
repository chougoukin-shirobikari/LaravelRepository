/**

Threadの表示(新着順)に関するjsファイル

**/

$(document).on('click', '#showThreadOrderByCreatedTime', function(event){
	event.preventDefault();
	let genreId = $(this).data('genreid');
	let haskeyword = $(this).data('haskeyword');
	let Url;

	if(haskeyword === 'yes'){
	  let keyword = $('#keyword').val();
	  Url = "/thread/showSearchedThread/orderByCreatedTime/" + genreId + "?keyword=" + keyword;
	}else{
	  Url = "/thread/showThread/orderByCreatedTime/" + genreId;
	}

	$.ajax({
		type: "GET",
		url : Url,
		data: {
                sort: $(this).data('sort')
            },
		dataType: "html",
	}).done(function(data, status, xhr){
			$('#content').html(data);

			if(haskeyword === 'yes'){
			  highlight();
			}
			console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
			console.log(XMLHttpRequest);
			console.log(status);
			console.log(errorThrown);
	})

});
