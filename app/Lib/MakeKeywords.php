<?php

namespace App\Lib;

Class MakeKeywords
{
    public static function makeKeywords($string)
    {
        $keyword = mb_convert_kana($string, 's');
        $keywords = preg_split('/[\s]+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);
        return $keywords;

    }

}
