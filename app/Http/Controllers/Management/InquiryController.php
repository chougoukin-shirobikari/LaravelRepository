<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Inquiry;
use App\UserInfo;
use App\Consts\Consts;
use App\Http\Requests\InquiryRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class InquiryController extends Controller
{
    //InquiryForm画面へ
    public function toInquiryForm()
    {
        return view('inquiryForm');
    }

    //お問い合わせ一覧を表示
    public function toInquiry()
    {
        $inquiryList = Inquiry::paginate(Consts::INQUIRY_PER_PAGE);

        $ngwordList = array();
        $userInfoList = array();

        return view('inquiry', [
            'collapse' => '',
            'ngword' => '',
            'userInfo' => '',
            'inquiry' => 'inquiry',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList
        ]);
    }

    //お問い合わせをする
    public function makeAnInquiry(InquiryRequest $request)
    {
        DB::transaction(function() use($request){
            $inquiry = new Inquiry;
            $inquiry->username = $request->username;
            $inquiry->message = $request->message;
            $inquiry->inquiry_time = date("Y-m-d (D) H:i");
            $inquiry->user_id = UserInfo::where('username', $request->username)->value('user_id');
            $inquiry->save();
            $name = $inquiry->username;
            //管理人へお問い合わせがあったことをメールで通知
            Mail::to(config('mail.username'))->send(new SendMail($name));
        });


        return redirect(url('toInquiryForm'))->with('success', 'success');
    }

    //お問い合わせを削除
    public function deleteInquiry($inquiry_id, Request $request)
    {
        DB::transaction(function() use($inquiry_id){
            $inquiry = Inquiry::find($inquiry_id);
            $inquiry->delete();
        });

        $inquiryList = Inquiry::paginate(Consts::INQUIRY_PER_PAGE, ['*'], 'page', $request->page);
        $inquiryList->withPath('/toInquiry');

        $ngwordList = array();
        $userInfoList = array();

        return view('inquiry', [
            'collapse' => '',
            'ngword' => '',
            'userInfo' => '',
            'inquiry' => 'inquiry',
            'ngwordList' => $ngwordList,
            'userInfoList' => $userInfoList,
            'inquiryList' => $inquiryList
        ]);

    }
}
