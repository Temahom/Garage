<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Voiture;
use Illuminate\Auth\Access\HandlesAuthorization;

class VoiturePolicy
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
     * @param  \App\Models\Voiture  $voiture
     * @return mixed
     */
    public function view(User $user, Voiture $voiture)
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
        return in_array($user->role_id,[2,4]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Voiture  $voiture
     * @return mixed
     */
    public function update(User $user, Voiture $voiture)
    {
        return in_array($user->role_id,[2,4]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Voiture  $voiture
     * @return mixed
     */
    public function delete(User $user, Voiture $voiture)
    {
        return in_array($user->role_id,[2,4]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Voiture  $voiture
     * @return mixed
     */
    public function restore(User $user, Voiture $voiture)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Voiture  $voiture
     * @return mixed
     */
    public function forceDelete(User $user, Voiture $voiture)
    {
        //
    }
}
