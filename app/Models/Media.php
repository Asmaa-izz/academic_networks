<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
