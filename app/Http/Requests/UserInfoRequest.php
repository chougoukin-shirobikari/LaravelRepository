<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Alphanumeric;

class UserInfoRequest extends FormRequest
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
            'username' => ['required', new Alphanumeric, 'between:2,20', 'unique:user_info'],
            'password' => ['required', new Alphanumeric, 'between:2,20']
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'ユーザー名を入力してください',
            'username.between' => '2文字以上20文字以内で入力してください',
            'username.unique' => 'エラー: 既に登録されたユーザー名です',
            'password.required' => 'パスワードを入力してください',
            'password.between' => '4文字以上で入力してください'
        ];
    }
}
