/**

お問い合わせ一覧の表示に関するjsファイル

**/

$(document).on('click', '#nav-item4-tab', function(event){
	event.preventDefault();
	let Url = "/toInquiry";

	$.ajax({
		type: "GET",
		url: Url,
		dataType: "html"
	}).done(function(data, status, xhr){
		$('#inquiryscreen').html(data);
        $('#nav-item1').hide();
        $('#nav-item2').hide();
        $('#nav-item3').hide();
        $('#nav-item4').attr('class', 'tab-pane fade show active');

		console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
		console.log(XMLHttpRequest);
		console.log(status);
		console.log(errorThrown);
	})

})
