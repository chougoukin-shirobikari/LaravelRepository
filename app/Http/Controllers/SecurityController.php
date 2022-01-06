<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\UserInfo;
use App\Http\Requests\UserINfoRequest;

class SecurityController extends Controller
{
    //Topページを表示
    public function showTopPage()
    {
        return view('toppage');
    }

    //ログイン画面を表示
    public function toLoginPage()
    {
        return view('login');
    }

    //新規登録画面を表示
    public function toRegister()
    {
        //ADMIN権限を持ったユーザーが存在するかチェック
        $adminUser = UserInfo::where('role', '=', 'ADMIN')->get();
        $adminExists = '';
        if(count($adminUser) > 0){
            $adminExists = 'yes';
        }else{
            $adminExists = 'no';
        }
        return view('register', ['adminExists' => $adminExists]);
    }

    //管理画面を表示
    public function toManagement()
    {
        $ngwordList = array();
        $userInfoList = array();
        $inquiryList = array();

        return view('layouts.management', [
            'collapse' => '',
            'ngword' => '',
            'userInfo' => '',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList
        ]);

    }

    //ログイン処理
    public function login(Request $request)
    {
        $userInfo = UserInfo::where('username', $request->username)->get();
        if(count($userInfo) === 0){
            return view('login');
        }

        if(Hash::check($request->password, $userInfo[0]->password)){
            session(['username' => $userInfo[0]->username]);
            session(['role' => $userInfo[0]->role]);
            return redirect(url('TopPage'));

        }else{
            return view('login');
        }
    }

    //ログアウト処理
    public function logout(Request $request)
    {
        session()->forget('username');
        session()->forget('role');

        return redirect(url('login'));
    }

    //ユーザーの新規登録処理
    public function regist(UserInfoRequest $request)
    {
        DB::transaction(function() use($request){
            $userInfo = new UserInfo;
            $userInfo->username = $request->username;
            $userInfo->password = Hash::make($request->password);
            $gender = $request->gender;
            var_dump($gender);
            if($gender === '0'){
                $userInfo->gender = '男性';
            }elseif($gender === '1'){
                $userInfo->gender = '女性';
            }else{
                $userInfo->gender = 'その他';
            }
            $role = $request->role;
            var_dump($role);
            if($role === 'admin'){
                $userInfo->role = 'ADMIN';
            }else{
                $userInfo->role = 'USER';
            }
            $userInfo->last_writing_time = date("Y-m-d");
            $userInfo->save();
        });

        return redirect(url('login'))->with('success', 'success');
    }

}
