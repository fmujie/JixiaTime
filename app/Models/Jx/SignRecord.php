<?php

namespace App\Models\Jx;

use Illuminate\Database\Eloquent\Model;

class SignRecord extends Model
{
    protected $table = 'signrecord';
    protected $guarded = ['id'];

    public function userInfor()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
