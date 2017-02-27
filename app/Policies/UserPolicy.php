<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user if admin in order to
     * update another user.
     *
     * @param  User  $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->level_id == 7;
    }

    /**
     * Determine if the given user if admin in order to
     * delete another user.
     *
     * @param  User  $user
     * @return bool
     */
    public function destroy(User $user)
    {
        return $user->level_id == 7;
    }
}
