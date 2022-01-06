/**

ページネーションに関するjsファイル

**/
$(function(){

    $(document).on('click', '#link_inquiry', function(event){
        event.preventDefault();
        let Url = $(this).attr('href');

        $.ajax({
            type: "GET",
            url : Url,
            dataType: "html",
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
        });
    });

});
