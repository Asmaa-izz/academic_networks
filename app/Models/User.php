<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class)
            ->withTimestamps()
            ->withPivot(['is_admin'])
            ->withPivot(['is_write_post'])
            ->withPivot(['is_write_comment']);
    }

    public function posts()
    {
        $this->hasMany(Post::class);
    }

    public function comments()
    {
        $this->hasMany(Comment::class);
    }

    public function pivotData($groupId)
    {
        // الحصول على العلاقة مع المجموعات
        $group = $this->groups()->find($groupId);

        if ($group) {
            // إذا كانت المجموعة موجودة، ارجع بيانات الـ pivot
            return $group->pivot;
        }

        return null; // إذا لم يكن هناك مجموعة مطابقة
    }
}
