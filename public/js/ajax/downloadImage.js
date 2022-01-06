/**

画像のダウンロードに関するjsファイル

**/

$(function(){
    $(document).on('click','#imageModalButton', function(event){
        event.preventDefault();
        $('#image').attr("src", "/URL");
        let postingId = $(this).data('postingid');
        let keyword = $(this).data('keyword');
        let haskeyword = $(this).data('haskeyword');
        let sort = $(this).data('sort');
        let Url = "/download/" + postingId;

        let deleteUrl;
        if(haskeyword === 'yes'){
            if(sort === 'orderByCreatedTime'){
                deleteUrl = "/posting/deleteSearchedPostingImage/orderByCreatedTime/" + postingId + "?keyword=" + keyword;
            }else{
                deleteUrl = "/posting/deleteSearchedPostingImage/" + postingId + "?keyword=" + keyword;
            }

        }else{
            if(sort === 'orderByCreatedTime'){
                deleteUrl = "/posting/deletePostingImage/orderByCreatedTime/" + postingId;
            }else{
                deleteUrl = "/posting/deletePostingImage/" + postingId;
            }
        }

        $('#deleteImageForm').attr('action', deleteUrl);

        $.ajax({
            type: "GET",
            url : Url,
            dataType: "text",
        }).done(function(data, status, xhr){
                $('#image').attr("src", data);
                console.log('ajax');
        }).fail(function(XMLHttpRequest, status, errorThrown){
                console.log(XMLHttpRequest);
                console.log(status);
                console.log(errorThrown);
        });

    });
});
