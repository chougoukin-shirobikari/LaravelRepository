<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';
    protected $primaryKey = 'user_id';
    protected $guarded = ['user_id'];
}
