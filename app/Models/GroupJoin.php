<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupJoin extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function userAccept()
    {
        return $this->belongsTo(User::class, 'user_accept');
    }

    public function userJoin()
    {
        return $this->belongsTo(User::class, 'user_join');
    }
}
