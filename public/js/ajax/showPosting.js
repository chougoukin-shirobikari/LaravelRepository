/**

投稿(Posting)の表示に関するjsファイル

**/

$(function(){
    $(document).on('click','#showPosting', function(event){
        event.preventDefault();
        let threadId = $(this).data('threadid');
        let Url = "/posting/showPostingByAjax/" + threadId;

        $.ajax({
            type: "GET",
            url : Url,
            dataType: "html",
        }).done(function(data, status, xhr){
                $('#content').html(data);
                console.log('ajax');
        }).fail(function(XMLHttpRequest, status, errorThrown){
                console.log(XMLHttpRequest);
                console.log(status);
                console.log(errorThrown);
        });

    });
    });
