/**

NgWord一覧の表示に関するjsファイル

**/

$(document).on('click', '#nav-item2-tab', function(event){
	event.preventDefault();
	let Url = "/toNgword";

	$.ajax({
		type: "GET",
		url: Url,
		dataType: "html"
	}).done(function(data, status, xhr){
		$('#ngwordscreen').html(data);
        $('#nav-item1').hide();
        $('#nav-item2').attr('class', 'tab-pane fade show active');
        $('#nav-item3').hide();
        $('#nav-item4').hide();

		console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
		console.log(XMLHttpRequest);
		console.log(status);
		console.log(errorThrown);
	})

})
