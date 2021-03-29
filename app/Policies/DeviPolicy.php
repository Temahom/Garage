<?php

namespace App\Policies;

use App\Models\Devi;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeviPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Devi  $devi
     * @return mixed
     */
    public function view(User $user, Devi $devi)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->role_id, [4,3]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Devi  $devi
     * @return mixed
     */
    public function update(User $user, Devi $devi)
    {
        return in_array($user->role_id, [4,3]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Devi  $devi
     * @return mixed
     */
    public function delete(User $user, Devi $devi)
    {
        return in_array($user->role_id, [4,3]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Devi  $devi
     * @return mixed
     */
    public function restore(User $user, Devi $devi)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Devi  $devi
     * @return mixed
     */
    public function forceDelete(User $user, Devi $devi)
    {
        //
    }
}
