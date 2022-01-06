/**

モーダル(削除するPostingを確認)の表示に関するjsファイル

**/

$(function(){
    let postingId;
    let threadId;
    let no;
    let name;
    let time;
    let message;
    let sort;
    let haskeyword;
    let keyword;
    let Url;
    $(document).on('click', '#modalButton', function(e){
        postingId = $(e.currentTarget).data('postingid');
        threadId = $(e.currentTarget).data('threadid');
        no = $(e.currentTarget).data('no');
        name = $(e.currentTarget).data('name');
        time = $(e.currentTarget).data('time');
        message = $(e.currentTarget).data('message');
        sort = $(e.currentTarget).data('sort');
        haskeyword = $(e.currentTarget).data('haskeyword');
        keyword = $(e.currentTarget).data('keyword');

        $('#modalNo').text(no);
        $('#modalName').text(name);
        $('#modalTime').text(time);
        $('#modalMessage').text(message);

        if(haskeyword === 'yes'){
            if(sort === 'orderByCreatedTime'){
                Url = "/posting/deleteSearchedPosting/orderByCreatedTime/" + threadId + "/" + postingId + "?keyword=" + keyword;
            }else{
                Url = "/posting/deleteSearchedPosting/" + threadId + "/" + postingId + "?keyword=" + keyword;
            }

        }else{
            if(sort === 'orderByCreatedTime'){
                Url = "/posting/deletePosting/orderByCreatedTime/" + threadId + "/" + postingId;
            }else{
                Url = "/posting/deletePosting/" + threadId + "/" + postingId;
            }
        }

        $('#modalDelete').attr('action', Url);

    })
})
