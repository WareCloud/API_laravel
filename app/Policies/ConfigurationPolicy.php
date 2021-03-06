<?php

namespace App\Policies;

use App\Configuration;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the configuration.
     *
     * @param  \App\User  $user
     * @param  \App\Configuration  $configuration
     * @return mixed
     */
    public function view(User $user, Configuration $configuration)
    {
        return $this->access($user, $configuration);
    }

    /**
     * Determine whether the user can create configurations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the configuration.
     *
     * @param  \App\User  $user
     * @param  \App\Configuration  $configuration
     * @return mixed
     */
    public function update(User $user, Configuration $configuration)
    {
        return $this->access($user, $configuration);
    }

    /**
     * Determine whether the user can delete the configuration.
     *
     * @param  \App\User  $user
     * @param  \App\Configuration  $configuration
     * @return mixed
     */
    public function delete(User $user, Configuration $configuration)
    {
        return $this->access($user, $configuration);
    }

    /**
     *
     * Determine whether the user can access the given configuration.
     * @param User $user
     * @param Configuration $configuration
     * @return bool
     *
     */
    public function access(User $user, Configuration $configuration)
    {
        return (int)$user->id === (int)$configuration->user_id;
    }
}
