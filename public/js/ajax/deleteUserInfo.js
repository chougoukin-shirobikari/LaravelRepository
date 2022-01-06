/**

UserInfoの削除に関するjsファイル

**/

$(document).on('click', '#deleteUserInfo', function(event){
	event.preventDefault();
    let userId = $(this).data('userid');
    let showGhostUser = $(this).data('showghostuser');
    let Url;

	if(showGhostUser === 'yes'){
	  Url = "/deleteGhostUser/" + userId;
	}else{
	  Url = "/deleteUserInfo/" + userId;
	}

	$.ajax({
		type: "DELETE",
		url: Url,
		data: {
            page: $(this).data('page'),
            _token: $("*[name=_token]").val()
            },
		dataType: "html"
	}).done(function(data, status, xhr){
		$('#userinfoscreen').html(data);
        $('#nav-item1').hide();
        $('#nav-item2').hide();
        $('#nav-item3').attr('class', 'tab-pane fade show active');
        $('#nav-item4').hide();
		console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
		console.log(XMLHttpRequest);
		console.log(status);
		console.log(errorThrown);
	})

})
