<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserInfo;
use App\Consts\Consts;

class UserInfoController extends Controller
{
    //会員情報を表示
    public function toUserInfo()
    {
        $ngwordList = array();
        $userInfoList = UserInfo::paginate(Consts::USERINFO_PER_PAGE);
        $inquiryList = array();

        return view('userInfo', [
            'collapse' => '',
            'ngword' => '',
            'userInfo' => 'userInfo',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList
        ]);
    }

    //会員情報を削除
    public function deleteUserInfo($user_id, Request $request)
    {
        DB::transaction(function() use($user_id){
            $user_info = UserInfo::find($user_id);
            $user_info->delete();
        });

        $ngwordList = array();
        $userInfoList = UserInfo::paginate(Consts::USERINFO_PER_PAGE, ['*'], 'page', $request->page);
        $userInfoList->withPath('/toUserInfo');
        $inquiryList = array();

        return view('userInfo', [
            'collapse' => '',
            'ngword' => '',
            'userInfo' => 'userInfo',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList
        ]);

    }

    //ユーザー名から会員情報を検索
    public function searchUsername(Request $request)
    {
        $userInfoList = UserInfo::where('username', $request->username)->paginate(1);
        $ngwordList = array();
        $inquiryList = array();

        if(count($userInfoList) === 0){
            $notFound = 'yes';
        }else{
            $notFound = 'no';
        }
        return view('userInfo', [
            'collapse' => '',
            'ngword' => '',
            'userInfo' => 'userInfo',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList,
            'notFound' => $notFound
        ]);

    }

    //３カ月間書き込みがないユーザーを表示する(幽霊会員を表示)
    public function searchGhostUser()
    {
        $time_threeMonthsAgo = date("Y-m-d", strtotime("-3 month"));
        $userInfoList = UserInfo::where('last_writing_time', '<', $time_threeMonthsAgo)->paginate(Consts::USERINFO_PER_PAGE);

        $ngwordList = array();
        $inquiryList = array();

        return view('userInfo', [
            'collapse' => '',
            'ngword' => '',
            'userInfo' => 'userInfo',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList,
            'showGhostUser' => 'yes'
        ]);

    }

    //３カ月間書き込みがないユーザーを削除
    public function deleteGhostUser($user_id, Request $request)
    {
        DB::transaction(function() use($user_id){
            $user_info = UserInfo::find($user_id);
            $user_info->delete();
        });

        $time_threeMonthsAgo = date("Y-m-d", strtotime("-3 month"));
        $userInfoList = UserInfo::where('last_writing_time', '<', $time_threeMonthsAgo)->paginate(Consts::USERINFO_PER_PAGE, ['*'], 'page', $request->page);
        $userInfoList->withPath('/searchGhostUser');
        $ngwordList = array();
        $inquiryList = array();

        return view('userInfo', [
            'collapse' => '',
            'ngword' => '',
            'userInfo' => 'userInfo',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList,
            'showGhostUser' => 'yes'
        ]);

    }

}
