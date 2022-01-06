/**

モーダル(削除するThreadを確認)の表示に関するjsファイル

**/

$(function(){
    let genreId;
    let threadId;
    let title;
    let sort;
    let haskeyword;
    let keyword;
    let Url;
    $(document).on('click', '#modalButton', function(e){
        genreId = $(e.currentTarget).data('genreid');
        threadId = $(e.currentTarget).data('threadid');
        title = $(e.currentTarget).data('title');
        sort = $(e.currentTarget).data('sort');
        haskeyword = $(e.currentTarget).data('haskeyword');
        keyword = $(e.currentTarget).data('keyword');

        $('#modalTitle').text(title);

        if(haskeyword === 'yes'){
            if(sort === 'orderByCreatedTime'){
                Url = "/thread/deleteSearchedThread/orderByCreatedTime/" + genreId + "/" + threadId + "?keyword=" + keyword;
            }else if(sort === 'orderByNumberOfPosting'){
                Url = "/thread/deleteSearchedThread/orderByNumberOfPosting/" + genreId + "/" + threadId + "?keyword=" + keyword;
            }else{
                Url = "/thread/deleteSearchedThread/" + genreId + "/" + threadId + "?keyword=" + keyword;
            }

        }else{
            if(sort === 'orderByCreatedTime'){
                Url = "/thread/deleteThread/orderByCreatedTime/" + genreId + "/" + threadId;
            }else if(sort === 'orderByNumberOfPosting'){
                Url = "/thread/deleteThread/orderByNumberOfPosting/" + genreId + "/" + threadId;
            }else{
                Url = "/thread/deleteThread/" + genreId + "/" + threadId;
            }
        }

        $('#modalDelete').attr('action', Url);

    });
});
