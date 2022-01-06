/**

ハイライト表示をする関数を定義したjsファイル

**/

function highlight(){

	var searchedwords_json = $('#searchedwords').val();
	let searchedwords = JSON.parse(searchedwords_json);
	let listSize = $('#listsize').data('listsize');

	for(i = 0; i < listSize; i++){
		let id = '#element' + i;
		let str;

		$.each(searchedwords, function(index){
			let regexp1 = new RegExp('(?<=>)[^<>]*?(' + searchedwords[index] +')[^<>]*?(?=<)','gi');
			let regexp2 = new RegExp(searchedwords[index], "gi");

			str = $(id).html().replace(regexp1, function(){
			  return arguments[0].replace(regexp2, function(matchWord){
			  return '<span class="highlight">'+ matchWord +'</span>';
			  })
			})

		    $(id).html(str);
		});
	}

}
