<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ThreadObservable;

class Thread extends Model
{
    protected $table = 'thread';
    protected $primaryKey = 'thread_id';

    use ThreadObservable;
}
