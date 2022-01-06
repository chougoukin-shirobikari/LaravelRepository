/**

ページネーションに関するjsファイル

**/
$(function(){

    $(document).on('click', 'a.page-link', function(event){
        event.preventDefault();
        let haskeyword = $('#pagination').data('haskeyword');
        let Url = $(this).attr('href');

        $.ajax({
            type: "GET",
            url : Url,
            //data: {keyword: $('#keyword').val()},
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
        });
    });

});
