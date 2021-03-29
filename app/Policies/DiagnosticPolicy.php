<?php

namespace App\Policies;

use App\Models\Diagnostic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiagnosticPolicy
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
     * @param  \App\Models\Diagnostic  $diagnostic
     * @return mixed
     */
    public function view(User $user, Diagnostic $diagnostic)
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
        return in_array($user->role_id, [3,4]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Diagnostic  $diagnostic
     * @return mixed
     */
    public function update(User $user, Diagnostic $diagnostic)
    {
        return in_array($user->role_id, [3,4]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Diagnostic  $diagnostic
     * @return mixed
     */
    public function delete(User $user, Diagnostic $diagnostic)
    {
        return in_array($user->role_id, [4,3]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Diagnostic  $diagnostic
     * @return mixed
     */
    public function restore(User $user, Diagnostic $diagnostic)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Diagnostic  $diagnostic
     * @return mixed
     */
    public function forceDelete(User $user, Diagnostic $diagnostic)
    {
        //
    }
}
