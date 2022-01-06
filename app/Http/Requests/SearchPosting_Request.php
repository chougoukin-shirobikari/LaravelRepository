<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchPosting_Request extends FormRequest
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
            'genre_title' => 'required',
            'thread_title' => 'required',
            'posting_no' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'genre_title.required' => '未入力',
            'thread_title.required' => '未入力',
            'posting_no.integer' => '半角の数字を入力してください',
        ];
    }
}
