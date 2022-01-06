/**

UserInfoの表示に関するjsファイル

**/

$(document).on('click', '#nav-item3-tab', function(event){
	event.preventDefault();
	let Url = "/toUserInfo";

	$.ajax({
		type: "GET",
		url: Url,
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

$(document).on('click', '#toUserInfo', function(event){
	event.preventDefault();
	let Url = "/toUserInfo";

	$.ajax({
		type: "GET",
		url: Url,
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

