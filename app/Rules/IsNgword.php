<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Ngword;

class IsNgword implements Rule
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
        $multidimentionalNgwordArray = Ngword::get(['ngword'])->toArray();
        foreach($multidimentionalNgwordArray as $ngwordArray){
            foreach($ngwordArray as $ngword){
                if(strpos($value, $ngword) !== false){
                    return false;
                }
            }
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
        return 'NGワードが含まれています';
    }
}
