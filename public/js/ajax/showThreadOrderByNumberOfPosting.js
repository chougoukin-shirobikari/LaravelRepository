/**

Threadの表示(投稿件数の多い順)に関するjsファイル

**/

$(document).on('click', '#showThreadOrderByNumberOfPosting', function(event){
	event.preventDefault();
	let genreId = $(this).data('genreid');
	let haskeyword = $(this).data('haskeyword');
	let Url;

	if(haskeyword === 'yes'){
        let keyword = $('#keyword').val();
        Url = "/thread/showSearchedThread/orderByNumberOfPosting/" + genreId + "?keyword=" + keyword;
      }else{
        Url = "/thread/showThread/orderByNumberOfPosting/" + genreId;
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

