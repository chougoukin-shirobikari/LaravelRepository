<?php

namespace App\Observers;

use App\Thread;
use Exception;
use App\Exceptions\OptimisticLockException;

class ThreadObserver
{
    public function updating(Thread $thread)
    {
        $thread_version = $thread->thread_version;
        $db_thread = Thread::find($thread->thread_id);
        $db_thread_version = $db_thread->thread_version;

        if($thread_version == $db_thread_version){
            $thread->thread_version = ++$thread_version;

        }else{
            throw new OptimisticLockException('排他制御エラー');
        }
    }
}
