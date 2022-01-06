<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsNgword;
use App\Rules\DoubleSpace;

class GenreRequest extends FormRequest
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
            'genre_title' => ['required', new DoubleSpace, 'max:8', new IsNgword, 'unique:genre']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'ジャンル名を入力してください',
            'max' => '８文字以内で入力してください',
            'unique' => 'エラー: ジャンルタイトルの重複'
        ];
    }
}
