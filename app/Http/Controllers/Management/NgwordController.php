<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ngword;
use App\Rules\DoubleSpace;
use Validator;

class NgwordController extends Controller
{
    //NGワード関連のタブを表示
    public function toNgword()
    {
        $ngwordList = Ngword::all();
        $userInfoList = array();
        $inquiryList = array();

        return view('ngword', [
            'collapse' => '',
            'ngword' => 'ngword',
            'userInfo' => '',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList
        ]);
    }

    //NGワードを登録
    public function registerNgword(Request $request)
    {
        $rules = [
            'ngword' => ['required', new DoubleSpace, 'max:8']
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $ngwordList = Ngword::all();
            $userInfoList = array();
            $inquiryList = array();

            return view('ngword', [
                'collapse' => '',
                'ngword' => 'ngword',
                'userInfo' => '',
                'inquiry' => '',
                'ngwordList' => $ngwordList,
                'userInfoList' => $userInfoList,
                'inquiryList' => $inquiryList,
                'ngword_error' => 'yes'
            ]);
        }

        //NGワードの登録
        DB::transaction(function() use($request){
            $ngword = new Ngword;
            $ngword->ngword = $request->ngword;
            $ngword->save();
        });

        $ngwordList = Ngword::all();
        $userInfoList = array();
        $inquiryList = array();

        return view('ngword', [
            'collapse' => '',
            'ngword' => 'ngword',
            'userInfo' => '',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList
        ]);
    }

    //NGワードの削除
    public function deleteNgword($ngword_id)
    {
        DB::transaction(function() use($ngword_id){
            $ngword = Ngword::find($ngword_id);
            $ngword->delete();

        });

        $ngwordList = Ngword::all();
        $userInfoList = array();
        $inquiryList = array();

        return view('ngword', [
            'collapse' => '',
            'ngword' => 'ngword',
            'userInfo' => '',
            'inquiry' => '',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList
        ]);
    }
}
