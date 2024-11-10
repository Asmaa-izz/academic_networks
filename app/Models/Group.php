<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot(['is_admin'])
            ->withPivot(['is_write_post'])
            ->withPivot(['is_write_comment'])
            ->withPivot(['is_share_content']);
    }

    public function admin(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot(['is_admin'])
            ->wherePivot('is_admin', true);
    }

    public function getAdmin()
    {
        return $this->admin()->first();
    }

    public function groupJoin()
    {
        return $this->hasMany(GroupJoin::class);
    }
}
