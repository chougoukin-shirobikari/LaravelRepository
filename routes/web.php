<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

//ログイン・新規登録
Route::get('/login', 'SecurityController@toLoginPage');
Route::post('/Authentication', 'SecurityController@login');
Route::get('/toRegister', 'SecurityController@toRegister');
Route::post('/regist', 'SecurityController@regist');

Route::group(['middleware' => 'login'], function(){
    //SecutiryController
    Route::get('/', 'SecurityController@showTopPage');
    Route::get('/TopPage', 'SecurityController@showTopPage');
    Route::post('/logout', 'SecurityController@logout');
    Route::get('/toManagement', 'SecurityController@toManagement');

    //SearchController
    Route::get('/toSearch', 'Management\SearchController@toSearch');
    Route::post('/searchPosting', 'Management\SearchController@searchPosting');
    Route::post('/searchReply', 'Management\SearchController@searchReply');

    //NgwordController
    Route::get('/toNgword', 'Management\NgwordController@toNgword');
    Route::post('/registerNgword', 'Management\NgwordController@registerNgword');
    Route::delete('/deleteNgword/{ngword_id}', 'Management\NgwordController@deleteNgword');

    //UserInfoController
    Route::get('/toUserInfo', 'Management\UserInfoController@toUserInfo');
    Route::delete('/deleteUserInfo/{user_id}', 'Management\UserInfoController@deleteUserInfo');
    Route::delete('/deleteGhostUser/{user_id}', 'Management\UserInfoController@deleteGhostUser');
    Route::post('/searchUsername', 'Management\UserInfoController@searchUsername');
    Route::get('/searchGhostUser', 'Management\UserInfoController@searchGhostUser');

    //InquiryController
    Route::get('/toInquiry', 'Management\InquiryController@toInquiry');
    Route::get('/toInquiryForm', 'Management\InquiryController@toInquiryForm');
    Route::post('/makeAnInquiry', 'Management\InquiryController@makeAnInquiry');
    Route::delete('/deleteInquiry/{inquiry_id}', 'Management\InquiryController@deleteInquiry');

    //DownloadController
    Route::get('/download/{posting_id}', 'DownloadController@returnImagePath');

    //GenreController
    Route::get('/genre/showGenre', 'Genre\GenreController@showGenre');
    Route::get('/genre/toGenreForm', 'Genre\GenreController@toGenreForm');
    Route::post('/genre/createGenre', 'Genre\GenreController@createGenre');
    Route::delete('/genre/deleteGenre/{genre_id}', 'Genre\GenreController@deleteGenre');

    //ThreadController
    Route::get('/thread/showThread/{genre_id}', 'Thread\ShowThreadController@orderByAsc');
    Route::get('/thread/showThreadByAjax/{genre_id}', 'Thread\ShowThreadController@orderByAscByAjax');
    Route::get('/thread/showThread/orderByCreatedTime/{genre_id}', 'Thread\ShowThreadController@orderByCreatedTime');
    Route::get('/thread/showThread/orderByNumberOfPosting/{genre_id}', 'Thread\ShowThreadController@orderByNumberOfPosting');
    Route::get('/thread/showUnwritableThread/{genre_id}', 'Thread\ShowThreadController@showUnwritableThread');
    Route::get('/thread/toThreadForm/{genre_id}', 'Thread\CreateThreadController@toThreadForm');
    Route::get('/thread/showSearchedThread/{genre_id}', 'Thread\ShowThreadController@showSearchedThread_orderByAsc');
    Route::get('/thread/showSearchedThread/orderByCreatedTime/{genre_id}', 'Thread\ShowThreadController@showSearchedThread_orderByCreatedTime');
    Route::get('/thread/showSearchedThread/orderByNumberOfPosting/{genre_id}', 'Thread\ShowThreadController@showSearchedThread_orderByNumberOfPosting');
    Route::post('/thread/createThread/{genre_id}', 'Thread\CreateThreadController@createThread');
    Route::delete('/thread/deleteThread/{genre_id}/{thread_id}', 'Thread\DeleteThreadController@deleteThread');
    Route::delete('/thread/deleteThread/orderByCreatedTime/{genre_id}/{thread_id}', 'Thread\DeleteThreadController@deleteThreadThenOrderByCreatedTime');
    Route::delete('/thread/deleteThread/orderByNumberOfPosting/{genre_id}/{thread_id}', 'Thread\DeleteThreadController@deleteThreadThenOrderByNumberOfPosting');
    Route::delete('/thread/deleteSearchedThread/{genre_id}/{thread_id}', 'Thread\DeleteThreadController@deleteSearchedThread');
    Route::delete('/thread/deleteSearchedThread/orderByCreatedTime/{genre_id}/{thread_id}', 'Thread\DeleteThreadController@deleteSearchedThreadThenOrderByCreatedTime');
    Route::delete('/thread/deleteSearchedThread/orderByNumberOfPosting/{genre_id}/{thread_id}', 'Thread\DeleteThreadController@deleteSearchedThreadThenOrderByNumberOfPosting');

    //PostingController
    Route::get('/posting/showPosting/{thread_id}', 'Posting\ShowPostingController@orderByAsc');
    Route::get('/posting/showPostingByAjax/{thread_id}', 'Posting\ShowPostingController@orderByAscByAjax');
    Route::get('/posting/showPosting/orderByCreatedTime/{thread_id}', 'Posting\ShowPostingController@orderByCreatedTime');
    Route::get('/posting/toPostingForm/{thread_id}', 'Posting\CreatePostingController@toPostingForm');
    Route::get('/posting/showSearchedPosting/{thread_id}', 'Posting\ShowPostingController@showSearchedPosting_orderByAsc');
    Route::get('/posting/showSearchedPosting/orderByCreatedTime/{thread_id}', 'Posting\ShowPostingController@showSearchedPosting_orderByCreatedTime');
    Route::post('/posting/createPosting/{thread_id}', 'Posting\CreatePostingController@createPosting');
    Route::patch('/posting/deletePosting/{thread_id}/{posting_id}', 'Posting\DeletePostingController@deletePosting');
    Route::patch('/posting/deletePosting/orderByCreatedTime/{thread_id}/{posting_id}', 'Posting\DeletePostingController@deletePostingThenOrderByCreatedTime');
    Route::patch('/posting/deleteSearchedPosting/{thread_id}/{posting_id}', 'Posting\DeletePostingController@deleteSearchedPosting');
    Route::patch('/posting/deleteSearchedPosting/orderByCreatedTime/{thread_id}/{posting_id}', 'Posting\DeletePostingController@deleteSearchedPostingThenOrderByCreatedTime');
    Route::delete('/posting/deletePostingImage/{posting_id}', 'Posting\DeletePostingController@deletePostingImage');
    Route::delete('/posting/deletePostingImage/orderByCreatedTime/{posting_id}', 'Posting\DeletePostingController@deletePostingImageThrenOrderByCreatedTime');
    Route::delete('/posting/deleteSearchedPostingImage/{posting_id}', 'Posting\DeletePostingController@deleteSearchedPostingImage');
    Route::delete('/posting/deleteSearchedPostingImage/orderByCreatedTime/{posting_id}', 'Posting\DeletePostingController@deleteSearchedPostingImageThenOrderByCreatedTime');


    //ReplyController
    Route::get('/reply/showReply/{posting_id}', 'Reply\ReplyController@showReply');
    Route::get('/reply/toReplyForm/{posting_id}', 'Reply\ReplyController@toReplyForm');
    Route::post('/reply/createReply/{posting_id}', 'Reply\ReplyController@createReply');
    Route::patch('/reply/deleteReply/{posting_id}/{reply_id}', 'Reply\ReplyController@deleteReply');

});

