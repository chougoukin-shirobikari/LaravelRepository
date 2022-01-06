<?php

namespace App\Observers;

use App\Posting;
use App\Exceptions\OptimisticLockException;

class PostingObserver
{
    public function updating(Posting $posting)
    {
        $posting_version = $posting->posting_version;
        $db_posting = Posting::find($posting->posting_id);
        $db_posting_version = $db_posting->posting_version;

        if($posting_version == $db_posting_version){
            $posting->posting_version = ++$posting_version;
        }else{
            throw new OptimisticLockException('排他制御エラー');
        }
    }
}
