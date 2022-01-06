<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\IsNgword;
use App\Rules\DoubleSpace;

class ThreadRequest extends FormRequest
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
            'thread_title' => ['required', new DoubleSpace, 'max:20', new IsNgword,  Rule::unique('thread')->where('genre_id', $this->genre_id)]
        ];
    }

    public function messages()
    {
        return [
            'required' => 'スレッドタイトルを入力してください',
            'max' => '20文字以内で入力してください',
            'unique' => 'エラー: スレッドタイトルの重複'
        ];
    }
}
