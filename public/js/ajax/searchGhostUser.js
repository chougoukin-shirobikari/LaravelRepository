/**

三カ月以上書き込みのないユーザーの検索に関するjsファイル

**/


$(document).on('click', '#searchGhostUser', function(event){
	event.preventDefault();
	let Url = "/searchGhostUser";

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
	}).fail(function(XMLHttpRequest, status, errorThrown){
		console.log(XMLHttpRequest);
		console.log(status);
		console.log(errorThrown);
	});
});
