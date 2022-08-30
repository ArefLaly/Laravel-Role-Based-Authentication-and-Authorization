<?php

namespace App\Policies;

use App\Common\CheckPermission;
use App\Common\Permission\Permissions;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return CheckPermission::hasRole($user, Permissions::$user[Permissions::$get]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        return CheckPermission::hasRole($user, Permissions::$user[Permissions::$get]);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return CheckPermission::hasRole($user, Permissions::$user[Permissions::$create]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        //user cannot update his parent, and it's self
        if (($user->created_by && $user->created_by == $model->id)
            || !$model->created_by
            || $user->id == $model->id
        ) {
            return false;
        }
        return CheckPermission::hasRole($user, Permissions::$user[Permissions::$update]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        //user cannot delete self, user cannot delete the user who created self,
        if (($user->created_by && $user->created_by == $model->id)
            || !$model->created_by
            || $user->id == $model->id
        ) {
            return false;
        }
        return CheckPermission::hasRole($user, Permissions::$user[Permissions::$delete]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        return CheckPermission::hasRole($user, Permissions::$user[Permissions::$create]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //user cannot delete self, user cannot delete the user who created self,
        if (($user->created_by && $user->created_by == $model->id)
            || !$model->created_by
            || $user->id == $model->id
        ) {
            return false;
        }
        return CheckPermission::hasRole($user, Permissions::$user[Permissions::$delete]);
    }
}
