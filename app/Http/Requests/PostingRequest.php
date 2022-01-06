<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsNgword;
use App\Rules\DoubleSpace;

class PostingRequest extends FormRequest
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
            'message' => ['required', new DoubleSpace, 'max:60', new IsNgword],
            'image' => ['file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'message.required' => 'メッセージを入力してください',
            'name.max' => '12文字以内で入力してください',
            'message.max' => '60文字以内で入力してください',
            'image.file' => '※エラーが発生したため画像を投稿できませんでした',
            'image.image' => '※エラーが発生したため画像を投稿できませんでした',
            'image.mines' => '※エラーが発生したため画像を投稿できませんでした',
            'image.max' => '※エラーが発生したため画像を投稿できませんでした'
        ];
    }
}
