<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DoubleSpace implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $strip = trim(mb_convert_kana($value, "s", 'UTF-8'));
        if(empty($strip)){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'エラー:入力がすべて全角スペースです';
    }
}
