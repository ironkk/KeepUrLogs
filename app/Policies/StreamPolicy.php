<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StreamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user if admin in order to
     * update an stream.
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
     * delete an stream.
     *
     * @param  User  $user
     * @return bool
     */
    public function destroy(User $user)
    {
        return $user->level_id == 7;
    }
}
