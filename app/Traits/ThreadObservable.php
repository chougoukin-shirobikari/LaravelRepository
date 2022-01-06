<?php

namespace App\Traits;

use App\Observers\ThreadObserver;

trait ThreadObservable
{
    public static function bootThreadObservable()
    {
        self::observe(ThreadObserver::class);
    }
}
