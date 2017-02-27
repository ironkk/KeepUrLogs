<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user if admin in order to
     * delete a project user.
     *
     * @param  User  $user
     * @return bool
     */
    public function destroy(User $user)
    {
        return $user->level_id == 7;
    }
}
