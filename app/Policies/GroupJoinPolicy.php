<?php

namespace App\Policies;

use App\Models\GroupJoin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupJoinPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, GroupJoin $groupJoin): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, GroupJoin $groupJoin): bool
    {
    }

    public function delete(User $user, GroupJoin $groupJoin): bool
    {
    }

    public function restore(User $user, GroupJoin $groupJoin): bool
    {
    }

    public function forceDelete(User $user, GroupJoin $groupJoin): bool
    {
    }
}
