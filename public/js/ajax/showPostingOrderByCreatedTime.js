/**

投稿(Posting)の表示(新着順)に関するjsファイル

**/

$(document).on('click','#showPostingOrderByCreatedTime', function(event){
	event.preventDefault();
	let threadId = $(this).data('threadid');
	let haskeyword = $(this).data('haskeyword');
	let Url;
	if(haskeyword === 'yes'){
	  let keyword = $('#keyword').val();
	  Url = "/posting/showSearchedPosting/orderByCreatedTime/" + threadId + "?keyword=" + keyword;
	}else{
	  Url = "/posting/showPosting/orderByCreatedTime/" + threadId;
	}

	$.ajax({
		type: "GET",
		url : Url,
		dataType: "html"
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
	});

});
