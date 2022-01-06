<?php

namespace App\Traits;

use App\Observers\PostingObserver;

trait PostingObservable
{
    public static function bootPostingObservable()
    {
        self::observe(PostingObserver::class);
    }
}
