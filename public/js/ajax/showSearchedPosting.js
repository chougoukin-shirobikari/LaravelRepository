/**

キーワードで検索された投稿(Posting)の表示に関するjsファイル

**/

$(function(){

    $(document).on('submit','#showSearchedPosting', function(event){
        event.preventDefault();
        let threadId = $(this).data('threadid');
        let Url = "/posting/showSearchedPosting/" + threadId;

        $.ajax({
            type: "GET",
            url : Url,
            data: {
                    keyword: $('#keyword').val(),
                   _token: $("*[name=_token]").val()
                },
            dataType: "html"
        }).done(function(data, status, xhr){
                $('#content').html(data);

                let isBlank = $('#isBlank').data('isblank')
                if(isBlank !== 'yes'){
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
