<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DoubleSpace;

class NgwordRequest extends FormRequest
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
            'ngword' => ['required', new DoubleSpace, 'max:8']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'エラー: 未入力',
            'max' => '８文字以内で入力してください'
        ];
    }
}
