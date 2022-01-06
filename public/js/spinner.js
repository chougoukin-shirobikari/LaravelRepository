/**

スピナーの表示に関するjsファイル

**/

$("form").on("submit", function(){
    console.log("submit");
	$("#fadeModal").modal("hide");
	$("#overlay").fadeIn(500);
	setTimeout(function(){
		$("#overlay").fadeOut(500);
	}, 3000);
});
