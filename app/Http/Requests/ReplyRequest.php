<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsNgword;
use App\Rules\DoubleSpace;

class ReplyRequest extends FormRequest
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
            'name' => ['required', new DoubleSpace, 'max:12', new IsNgword],
            'reply_message' => ['required', new DoubleSpace, 'max:60', new IsNgword]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'reply_message.required' => 'メッセージを入力してください',
            'name.max' => '12文字以内で入力してください',
            'reply_message.max' => '60文字以内で入力してください'
        ];
    }
}
