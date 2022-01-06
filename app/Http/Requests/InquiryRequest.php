<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsNgword;
use App\Rules\DoubleSpace;

class InquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required',new DoubleSpace,'max:20', new IsNgword],
            'message' => ['required',new DoubleSpace,'max:60', new IsNgword]
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'ユーザー名を入力してください',
            'username.max' => '20文字以内で入力してください',
            'message.required' => 'メッセージを入力してください',
            'message.max' => '60文字以内で入力してください'
        ];
    }
}
