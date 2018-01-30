<?php

namespace App\Policies;

use App\Configuration;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function access(User $user, Configuration $configuration)
    {
        return (int)$user->id === (int)$configuration->user_id;
    }
}
