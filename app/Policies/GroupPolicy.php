<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        // الدكتور يشاهد جميع مجموعاته
        return $user->can('access_group');
    }

    public function view(User $user, Group $group): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->can('create_group');
    }

    public function update(User $user, Group $group): bool
    {
        if ($group->user_id === $user->id) {
            return true;
        }

        if ($group->getAdmin()->id === $user->id) {
            return true;
        }

        return false;
    }

    public function delete(User $user, Group $group): bool
    {
        if ($user->can('delete_group')) {
            if ($group->user_id === $user->id) {
                return true;
            }
        }
        return false;
    }

}
