<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PostingObservable;

class Posting extends Model
{
    protected $table = 'posting';
    protected $primaryKey = 'posting_id';

    use PostingObservable;
}
