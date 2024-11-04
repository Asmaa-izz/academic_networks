<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('access_user');
    }

    public function view(User $user, User $model): bool
    {
        return $user->can('access_user');
    }

    public function create(User $user): bool
    {
        return $user->can('create_user');
    }

    public function update(User $user, User $model): bool
    {
        if($user->id === $model->id){
            return true;
        }
        if($user->hasRole('doctor')){
            return  $user->can('update_user');
        }
        return false;
    }

    public function delete(User $user, User $model): bool
    {
        return $user->can('delete_user');
    }

}
