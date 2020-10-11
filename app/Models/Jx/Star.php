<?php

namespace App\Models\Jx;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $table = 'star';
    protected $guarded = ['id'];

    public $timestamps = false;
}
