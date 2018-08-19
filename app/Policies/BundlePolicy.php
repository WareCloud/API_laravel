<?php

namespace App\Policies;

use App\User;
use App\Bundle;
use Illuminate\Auth\Access\HandlesAuthorization;

class BundlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the bundle.
     *
     * @param  \App\User  $user
     * @param  \App\Bundle  $bundle
     * @return mixed
     */
    public function view(User $user, Bundle $bundle)
    {
        return $this->access($user, $bundle);
    }

    /**
     * Determine whether the user can create bundles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the bundle.
     *
     * @param  \App\User  $user
     * @param  \App\Bundle  $bundle
     * @return mixed
     */
    public function update(User $user, Bundle $bundle)
    {
        return $this->access($user, $bundle);
    }

    /**
     * Determine whether the user can delete the bundle.
     *
     * @param  \App\User  $user
     * @param  \App\Bundle  $bundle
     * @return mixed
     */
    public function delete(User $user, Bundle $bundle)
    {
        return $this->access($user, $bundle);
    }

    /**
     *
     * Determine whether the user can access the given bundle.
     * @param User $user
     * @param Bundle $bundle
     * @return bool
     *
     */
    public function access(User $user, Bundle $bundle)
    {
        return (int)$user->id === (int)$bundle->user_id;
    }
}
