/**

管理画面のPosting,Reply検索画面の表示に関するjsファイル

**/

$(document).on('click', '#nav-item1-tab', function(event){
	event.preventDefault();
	let Url = "/toSearch";

	$.ajax({
		type: "GET",
		url: Url,
		dataType: "html"
	}).done(function(data, status, xhr){
		$('#searchscreen').html(data);
        $('#nav-item1').attr('class', 'tab-pane fade show active')
        $('#nav-item2').hide();
        $('#nav-item3').hide();
        $('#nav-item4').hide();
		console.log('ajax');
	}).fail(function(XMLHttpRequest, status, errorThrown){
		console.log(XMLHttpRequest);
		console.log(status);
		console.log(errorThrown);
	})

})

