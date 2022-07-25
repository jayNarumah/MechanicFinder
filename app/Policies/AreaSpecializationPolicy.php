<?php

namespace App\Policies;

use App\Models\AreaSpecialization;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AreaSpecializationPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaSpecialization  $areaSpecialization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AreaSpecialization $areaSpecialization)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaSpecialization  $areaSpecialization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AreaSpecialization $areaSpecialization)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaSpecialization  $areaSpecialization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AreaSpecialization $areaSpecialization)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaSpecialization  $areaSpecialization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AreaSpecialization $areaSpecialization)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaSpecialization  $areaSpecialization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AreaSpecialization $areaSpecialization)
    {
        //
    }
}
