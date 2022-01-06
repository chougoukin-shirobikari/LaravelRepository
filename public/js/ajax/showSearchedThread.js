/**

キーワードで検索されたThreadの表示に関するjsファイル

**/


$(function(){
    $(document).on('submit','#showSearchedThread', function(event){
        event.preventDefault();
        let genreId = $(this).data('genreid');
        let Url = "/thread/showSearchedThread/" + genreId;

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
